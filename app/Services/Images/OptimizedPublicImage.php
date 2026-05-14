<?php

declare(strict_types=1);

namespace App\Services\Images;

use GdImage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Redimensiona y re-codifica imágenes raster con la extensión GD de PHP (sin dependencias Composer).
 * GIF se guarda sin procesar para no romper animaciones. Si GD no está disponible o falla la lectura,
 * se delega en el almacenamiento estándar de Laravel.
 */
final class OptimizedPublicImage
{
    private const MAX_EDGE = 1920;

    private const WEBP_QUALITY = 82;

    private const JPEG_QUALITY = 85;

    public static function store(UploadedFile $file, string $directory): string
    {
        $directory = trim($directory, '/');

        if (! extension_loaded('gd')) {
            return $file->store($directory, 'public');
        }

        $mime = $file->getMimeType() ?? '';

        if ($mime === 'image/gif') {
            return $file->store($directory, 'public');
        }

        $srcPath = $file->getRealPath();
        if ($srcPath === false) {
            return $file->store($directory, 'public');
        }

        $image = self::createFromFile($srcPath, $mime);
        if ($image === false) {
            return $file->store($directory, 'public');
        }

        try {
            $work = self::resizeIfNeeded($image);
            if ($work !== $image) {
                unset($image);
            }
            $image = $work;

            $name = Str::uuid()->toString();
            $webpSupported = function_exists('imagewebp')
                && (bool) (gd_info()['WebP Support'] ?? false);

            $tmp = tempnam(sys_get_temp_dir(), 'optimg');
            if ($tmp === false) {
                return $file->store($directory, 'public');
            }

            try {
                if ($webpSupported) {
                    $relative = "{$directory}/{$name}.webp";
                    $ok = imagewebp($image, $tmp, self::WEBP_QUALITY);
                } elseif ($mime === 'image/png' || $mime === 'image/webp') {
                    imagealphablending($image, false);
                    imagesavealpha($image, true);
                    $relative = "{$directory}/{$name}.png";
                    $ok = imagepng($image, $tmp, 6);
                } else {
                    $relative = "{$directory}/{$name}.jpg";
                    $ok = imagejpeg($image, $tmp, self::JPEG_QUALITY);
                }

                if (! $ok || ! is_readable($tmp)) {
                    return $file->store($directory, 'public');
                }

                $bytes = file_get_contents($tmp);
                if ($bytes === false) {
                    return $file->store($directory, 'public');
                }

                Storage::disk('public')->put($relative, $bytes);

                return $relative;
            } finally {
                @unlink($tmp);
            }
        } finally {
            unset($image);
        }
    }

    private static function createFromFile(string $path, string $mime): GdImage|false
    {
        return match ($mime) {
            'image/jpeg' => @imagecreatefromjpeg($path),
            'image/png' => @imagecreatefrompng($path),
            'image/webp' => function_exists('imagecreatefromwebp') ? @imagecreatefromwebp($path) : false,
            default => false,
        };
    }

    private static function resizeIfNeeded(GdImage $src): GdImage
    {
        $w = imagesx($src);
        $h = imagesy($src);
        if ($w <= self::MAX_EDGE && $h <= self::MAX_EDGE) {
            return $src;
        }

        $ratio = min(self::MAX_EDGE / $w, self::MAX_EDGE / $h);
        $nw = max(1, (int) round($w * $ratio));
        $nh = max(1, (int) round($h * $ratio));
        $dst = imagecreatetruecolor($nw, $nh);
        imagealphablending($dst, false);
        imagesavealpha($dst, true);
        $transparent = imagecolorallocatealpha($dst, 0, 0, 0, 127);
        imagefill($dst, 0, 0, $transparent);
        imagealphablending($dst, true);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $nw, $nh, $w, $h);
        imagealphablending($dst, false);
        imagesavealpha($dst, true);

        return $dst;
    }
}
