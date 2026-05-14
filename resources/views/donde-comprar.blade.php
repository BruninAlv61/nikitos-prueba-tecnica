@extends('layouts.app')

@php
    $provinciasOrdenadas = collect($sedes)->pluck('provincia')->unique()->sort()->values();
@endphp

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/leaflet/leaflet.css') }}">
@endpush

@php
    $dondeCfg = [
        'sedes'   => $sedes,
        'logoUrl' => asset('images/logo.png'),
    ];
@endphp

@section('content')
    <x-page-hero
        :image="asset('images/donde-comprar.png')"
        title="Dónde comprar"
        heading-id="donde-comprar-hero-titulo"
    />
    <div class="donde-comprar-wrapper">
        <div
            class="donde-comprar"
            data-donde-comprar
            data-logo-url="{{ e(asset('images/logo.png')) }}"
        >
            <aside class="donde-comprar__sidebar" aria-label="Listado de puntos de venta">
                <div class="donde-comprar__sidebar-head">
                    <label class="donde-comprar__label" for="donde-comprar-provincia">Provincia</label>
                    <select id="donde-comprar-provincia" class="donde-comprar__select" data-provincia-filter>
                        <option value="">Provincia</option>
                        @foreach ($provinciasOrdenadas as $provincia)
                            <option value="{{ $provincia }}">{{ $provincia }}</option>
                        @endforeach
                    </select>
                </div>
                <ul class="donde-comprar__list" data-sedes-list role="list">
                    @foreach ($sedes as $sede)
                        <li
                            class="donde-comprar__li"
                            data-sede-item
                            data-provincia="{{ $sede['provincia'] }}"
                        >
                            <button
                                type="button"
                                class="donde-comprar__item"
                                data-sede-id="{{ $sede['id'] }}"
                                data-lat="{{ $sede['lat'] }}"
                                data-lng="{{ $sede['lng'] }}"
                                data-provincia="{{ $sede['provincia'] }}"
                                aria-label="Ver en mapa: {{ $sede['ciudad'] }}, {{ $sede['provincia'] }}"
                            >
                                <span class="donde-comprar__provincia">{{ $sede['provincia'] }}</span>
                                <span class="donde-comprar__ciudad">{{ $sede['ciudad'] }}</span>
                            </button>
                        </li>
                    @endforeach
                </ul>
            </aside>
            <div class="donde-comprar__map-wrap">
                <div id="donde-comprar-map" class="donde-comprar__map" role="application" aria-label="Mapa de Argentina con puntos de venta"></div>
                <p class="donde-comprar__map-fallback" data-map-fallback hidden>No se pudo cargar el mapa. Comprobá tu conexión o probá recargar la página.</p>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>window.__DONDE_COMPRAR__ = @json($dondeCfg);</script>
    <script src="{{ asset('vendor/leaflet/leaflet.js') }}"></script>
    <script src="{{ asset('js/nikitos-maps.js') }}"></script>
@endpush
