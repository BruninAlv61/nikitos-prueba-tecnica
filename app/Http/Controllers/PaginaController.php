<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\InicioContenido;
use App\Models\NosotrosContenido;
use App\Models\Producto;
use App\Models\Receta;

class PaginaController extends Controller
{
    public function home()
    {
        $categorias = Categoria::take(4)->get();
        $destacados = Producto::where('destacado', true)->with('categoria')->take(4)->get();
        $recetasHome = Receta::latest()->take(3)->get();
        $inicioContenido = InicioContenido::registro();

        return view('home', compact('categorias', 'destacados', 'recetasHome', 'inicioContenido'));
    }

    public function nosotros()
    {
        $contenido = NosotrosContenido::registro();

        return view('nosotros', compact('contenido'));
    }

    public function dondeComprar()
    {
        return view('donde-comprar', [
            'sedes' => self::mockSedesArgentina(),
        ]);
    }

    public function recetas()
    {
        return view('recetas');
    }

    public function rse()
    {
        return view('pagina-placeholder', ['titulo' => 'RSE']);
    }

    public function politicasCalidad()
    {
        return view('pagina-placeholder', ['titulo' => 'Políticas de calidad']);
    }

    /**
     * @return list<array{id: int, provincia: string, ciudad: string, lat: float, lng: float}>
     */
    private static function mockSedesArgentina(): array
    {
        return [
            ['id' => 1, 'provincia' => 'Buenos Aires', 'ciudad' => 'LA PLATA', 'lat' => -34.9214, 'lng' => -57.9544],
            ['id' => 2, 'provincia' => 'Buenos Aires', 'ciudad' => 'LOMAS DE ZAMORA', 'lat' => -34.7609, 'lng' => -58.4063],
            ['id' => 3, 'provincia' => 'Buenos Aires', 'ciudad' => 'ADROGUE', 'lat' => -34.8004, 'lng' => -58.3845],
            ['id' => 4, 'provincia' => 'Buenos Aires', 'ciudad' => 'MAR DEL PLATA', 'lat' => -38.0055, 'lng' => -57.5426],
            ['id' => 5, 'provincia' => 'Buenos Aires', 'ciudad' => 'BAHÍA BLANCA', 'lat' => -38.7183, 'lng' => -62.2663],
            ['id' => 6, 'provincia' => 'Buenos Aires', 'ciudad' => 'QUILMES', 'lat' => -34.7206, 'lng' => -58.2546],
            ['id' => 7, 'provincia' => 'Buenos Aires', 'ciudad' => 'SAN ISIDRO', 'lat' => -34.4708, 'lng' => -58.5282],
            ['id' => 8, 'provincia' => 'Buenos Aires', 'ciudad' => 'TANDIL', 'lat' => -37.3217, 'lng' => -59.1332],
            ['id' => 9, 'provincia' => 'CABA', 'ciudad' => 'PALERMO', 'lat' => -34.5889, 'lng' => -58.4248],
            ['id' => 10, 'provincia' => 'CABA', 'ciudad' => 'CABALLITO', 'lat' => -34.6168, 'lng' => -58.4441],
            ['id' => 11, 'provincia' => 'Córdoba', 'ciudad' => 'CÓRDOBA CAPITAL', 'lat' => -31.4201, 'lng' => -64.1888],
            ['id' => 12, 'provincia' => 'Córdoba', 'ciudad' => 'VILLA MARÍA', 'lat' => -32.4075, 'lng' => -63.2407],
            ['id' => 13, 'provincia' => 'Córdoba', 'ciudad' => 'RÍO CUARTO', 'lat' => -33.1245, 'lng' => -64.3499],
            ['id' => 14, 'provincia' => 'Santa Fe', 'ciudad' => 'ROSARIO', 'lat' => -32.9442, 'lng' => -60.6505],
            ['id' => 15, 'provincia' => 'Santa Fe', 'ciudad' => 'SANTA FE CAPITAL', 'lat' => -31.6333, 'lng' => -60.7000],
            ['id' => 16, 'provincia' => 'Santa Fe', 'ciudad' => 'RAFAELA', 'lat' => -31.2503, 'lng' => -61.4867],
            ['id' => 17, 'provincia' => 'Mendoza', 'ciudad' => 'MENDOZA CAPITAL', 'lat' => -32.8895, 'lng' => -68.8458],
            ['id' => 18, 'provincia' => 'Mendoza', 'ciudad' => 'SAN RAFAEL', 'lat' => -34.6177, 'lng' => -68.3301],
            ['id' => 19, 'provincia' => 'Tucumán', 'ciudad' => 'SAN MIGUEL DE TUCUMÁN', 'lat' => -26.8083, 'lng' => -65.2176],
            ['id' => 20, 'provincia' => 'Salta', 'ciudad' => 'SALTA CAPITAL', 'lat' => -24.7821, 'lng' => -65.4232],
            ['id' => 21, 'provincia' => 'Jujuy', 'ciudad' => 'SAN SALVADOR DE JUJUY', 'lat' => -24.1858, 'lng' => -65.2995],
            ['id' => 22, 'provincia' => 'Entre Ríos', 'ciudad' => 'PARANÁ', 'lat' => -31.7413, 'lng' => -60.5116],
            ['id' => 23, 'provincia' => 'Entre Ríos', 'ciudad' => 'CONCORDIA', 'lat' => -31.3928, 'lng' => -58.0209],
            ['id' => 24, 'provincia' => 'Corrientes', 'ciudad' => 'CORRIENTES CAPITAL', 'lat' => -27.4692, 'lng' => -58.8306],
            ['id' => 25, 'provincia' => 'Misiones', 'ciudad' => 'POSADAS', 'lat' => -27.3621, 'lng' => -55.8968],
            ['id' => 26, 'provincia' => 'Chaco', 'ciudad' => 'RESISTENCIA', 'lat' => -27.4514, 'lng' => -58.9867],
            ['id' => 27, 'provincia' => 'Formosa', 'ciudad' => 'FORMOSA CAPITAL', 'lat' => -26.1775, 'lng' => -58.1781],
            ['id' => 28, 'provincia' => 'Neuquén', 'ciudad' => 'NEUQUÉN CAPITAL', 'lat' => -38.9516, 'lng' => -68.0591],
            ['id' => 29, 'provincia' => 'Río Negro', 'ciudad' => 'BARILOCHE', 'lat' => -41.1335, 'lng' => -71.3103],
            ['id' => 30, 'provincia' => 'Chubut', 'ciudad' => 'COMODORO RIVADAVIA', 'lat' => -45.8641, 'lng' => -67.4966],
            ['id' => 31, 'provincia' => 'Santa Cruz', 'ciudad' => 'RÍO GALLEGOS', 'lat' => -51.6226, 'lng' => -69.2181],
            ['id' => 32, 'provincia' => 'Tierra del Fuego', 'ciudad' => 'USHUAIA', 'lat' => -54.8019, 'lng' => -68.3030],
            ['id' => 33, 'provincia' => 'La Pampa', 'ciudad' => 'SANTA ROSA', 'lat' => -36.6203, 'lng' => -64.2900],
            ['id' => 34, 'provincia' => 'San Juan', 'ciudad' => 'SAN JUAN CAPITAL', 'lat' => -31.5375, 'lng' => -68.5364],
            ['id' => 35, 'provincia' => 'La Rioja', 'ciudad' => 'LA RIOJA CAPITAL', 'lat' => -29.4131, 'lng' => -66.8558],
            ['id' => 36, 'provincia' => 'Catamarca', 'ciudad' => 'SAN FERNANDO DEL VALLE', 'lat' => -28.4696, 'lng' => -65.7792],
        ];
    }
}
