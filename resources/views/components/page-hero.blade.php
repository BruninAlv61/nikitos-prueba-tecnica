@props([
    'image',
    'title',
    'headingId'    => null,
    'description'  => null,
    'align'        => 'bottom',
    'overlayImage' => null,
])

@php
    $resolvedHeadingId = $headingId ?? 'page-hero-heading';
@endphp

<header
    {{ $attributes->class([
        'page-hero',
        'page-hero--align-center'      => $align === 'center',
        'page-hero--has-overlay-image' => filled($overlayImage),
    ]) }}
    aria-labelledby="{{ $resolvedHeadingId }}"
>
    {{-- Imagen de fondo como <img> real, posicionada absolutamente detrás del texto --}}
    <img
        class="page-hero__bg"
        src="{{ $image }}"
        alt=""
        aria-hidden="true"
    />

    <div class="page-hero__inner">
        <h1 id="{{ $resolvedHeadingId }}" class="page-hero__title">{{ $title }}</h1>
        @if (filled($description))
            <p class="page-hero__description">{{ $description }}</p>
        @endif
        {{ $slot }}
    </div>

    {{-- PNG decorativo opcional que se superpone al contenido siguiente --}}
    @if (filled($overlayImage))
        <img
            class="page-hero__overlay-image"
            src="{{ $overlayImage }}"
            alt=""
            aria-hidden="true"
        />
    @endif

    <div class="page-hero__tear" aria-hidden="true">
        <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 1440 56"
            preserveAspectRatio="none"
            class="page-hero__tear-svg"
        >
            <path
                fill="currentColor"
                d="M0,44 L48,30 L96,42 L152,24 L220,46 L288,28 L356,48 L420,22 L488,44 L552,26 L620,50 L688,20 L756,42 L820,28 L892,46 L960,24 L1028,44 L1096,30 L1168,48 L1236,22 L1304,40 L1368,28 L1440,38 L1440,56 L0,56 Z"
            />
        </svg>
    </div>
</header>
