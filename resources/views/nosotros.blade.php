@extends('layouts.app')

@section('content')
    <article class="nosotros-page">
        <x-page-hero
            :image="asset('images/nosotros.png')"
            :title="$contenido->hero_titulo"
            heading-id="nosotros-hero-titulo"
        />

        <div class="nosotros-page__sections">
            <section class="nosotros-page__row" aria-labelledby="nosotros-s1">
                <div class="nosotros-page__copy">
                    <h2 id="nosotros-s1" class="nosotros-page__h2">{{ $contenido->seccion_1_titulo }}</h2>
                    @include('partials.nosotros-parrafos', ['cuerpo' => $contenido->seccion_1_cuerpo])
                </div>
                <figure class="nosotros-page__figure">
                    <img
                        class="nosotros-page__img"
                        src="{{ asset('images/nos1.png') }}"
                        alt="Línea de producción y envasado en planta Nikitos"
                        width="800"
                        height="520"
                        loading="lazy"
                        decoding="async"
                    >
                </figure>
            </section>

            <section class="nosotros-page__row nosotros-page__row--reverse" aria-labelledby="nosotros-s2">
                <div class="nosotros-page__copy">
                    <h2 id="nosotros-s2" class="nosotros-page__h2">{{ $contenido->seccion_2_titulo }}</h2>
                    @include('partials.nosotros-parrafos', ['cuerpo' => $contenido->seccion_2_cuerpo])
                </div>
                <figure class="nosotros-page__figure">
                    <img
                        class="nosotros-page__img"
                        src="{{ asset('images/nos2.png') }}"
                        alt="Producción de snacks en cintas transportadoras"
                        width="800"
                        height="520"
                        loading="lazy"
                        decoding="async"
                    >
                </figure>
            </section>

            <section class="nosotros-page__row" aria-labelledby="nosotros-s3">
                <div class="nosotros-page__copy">
                    <h2 id="nosotros-s3" class="nosotros-page__h2">{{ $contenido->seccion_3_titulo }}</h2>
                    @include('partials.nosotros-parrafos', ['cuerpo' => $contenido->seccion_3_cuerpo])
                </div>
                <figure class="nosotros-page__figure">
                    <img
                        class="nosotros-page__img"
                        src="{{ asset('images/nos3.png') }}"
                        alt="Equipo de planta en tareas de control de calidad"
                        width="800"
                        height="520"
                        loading="lazy"
                        decoding="async"
                    >
                </figure>
            </section>

            <section class="nosotros-page__row nosotros-page__row--reverse" aria-labelledby="nosotros-s4">
                <div class="nosotros-page__copy">
                    <h2 id="nosotros-s4" class="nosotros-page__h2">{{ $contenido->seccion_4_titulo }}</h2>
                    @include('partials.nosotros-parrafos', ['cuerpo' => $contenido->seccion_4_cuerpo])
                </div>
                <figure class="nosotros-page__figure">
                    <img
                        class="nosotros-page__img"
                        src="{{ asset('images/nos4.png') }}"
                        alt="Logística y distribución con flota Nikitos"
                        width="800"
                        height="520"
                        loading="lazy"
                        decoding="async"
                    >
                </figure>
            </section>
        </div>
    </article>
@endsection
