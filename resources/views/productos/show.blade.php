@extends('layouts.app')

@php
    $imagenPrincipal = $producto->imagen_url;
    $imagenesGaleria = array_values(array_unique(array_filter([$producto->imagen_url])));
    if ($imagenesGaleria === []) {
        $imagenesGaleria = [$imagenPrincipal];
    }
@endphp

@section('content')
    <article class="productos-categoria-page productos-producto-page">
        <x-page-hero
            :image="asset('images/productos.png')"
            title="Productos"
            heading-id="productos-show-hero-heading"
        />

        <div class="productos-categoria-page__shell">
            <div class="productos-categoria-page__layout">
                <div class="productos-categoria-page__nav-mobile">
                    <label class="productos-categoria-page__nav-mobile-label" for="productos-categoria-jump">
                        Categoría
                    </label>
                    <select id="productos-categoria-jump" class="productos-categoria-page__nav-mobile-select">
                        @foreach ($categorias as $cat)
                            <option
                                value="{{ route('productos.categoria', $cat->id) }}"
                                @selected($cat->id === $categoria->id)
                            >
                                {{ $cat->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <aside class="productos-categoria-page__sidebar" aria-labelledby="productos-show-nav-heading">
                    <h2 id="productos-show-nav-heading" class="sr-only">
                        Categorías de productos
                    </h2>
                    <ul class="productos-categoria-page__sidebar-nav">
                        @foreach ($categorias as $cat)
                            <li class="productos-categoria-page__sidebar-item">
                                <a
                                    href="{{ route('productos.categoria', $cat->id) }}"
                                    class="productos-categoria-page__sidebar-link @if ($cat->id === $categoria->id) productos-categoria-page__sidebar-link--current @endif"
                                >
                                    <span
                                        class="productos-categoria-page__sidebar-bar"
                                        style="--categoria-accent: {{ $cat->color ?? '#94a3b8' }}"
                                        aria-hidden="true"
                                    ></span>
                                    <span>{{ $cat->nombre }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </aside>

                <div class="productos-categoria-page__main">
                    <nav class="productos-producto-page__pager" aria-label="Producto anterior o siguiente">
                        @if ($anterior)
                            <a
                                href="{{ route('productos.show', [$categoria->id, $anterior->id]) }}"
                                class="productos-producto-page__pager-link"
                            >
                                ← Anterior
                            </a>
                        @else
                            <span class="productos-producto-page__pager-link productos-producto-page__pager-link--disabled">
                                ← Anterior
                            </span>
                        @endif

                        @if ($siguiente)
                            <a
                                href="{{ route('productos.show', [$categoria->id, $siguiente->id]) }}"
                                class="productos-producto-page__pager-link productos-producto-page__pager-link--next"
                            >
                                Siguiente →
                            </a>
                        @else
                            <span
                                class="productos-producto-page__pager-link productos-producto-page__pager-link--next productos-producto-page__pager-link--disabled"
                            >
                                Siguiente →
                            </span>
                        @endif
                    </nav>

                    <div class="producto-detail">
                        <div class="producto-detail__cols">
                            <div class="producto-detail__gallery">
                                <figure class="producto-detail__main-wrap">
                                    <img
                                        id="producto-gallery-main"
                                        class="producto-detail__main-img"
                                        src="{{ $imagenPrincipal }}"
                                        alt="{{ $producto->nombre }}"
                                        width="640"
                                        height="640"
                                        decoding="async"
                                        fetchpriority="high"
                                    >
                                </figure>
                                <ul class="producto-detail__thumbs" role="list">
                                    @foreach ($imagenesGaleria as $idx => $src)
                                        <li>
                                            <button
                                                type="button"
                                                class="producto-detail__thumb @if ($idx === 0) is-active @endif"
                                                data-full="{{ $src }}"
                                                aria-pressed="{{ $idx === 0 ? 'true' : 'false' }}"
                                                aria-label="Miniatura {{ $idx + 1 }} de {{ count($imagenesGaleria) }}"
                                            >
                                                <img
                                                    src="{{ $src }}"
                                                    alt=""
                                                    width="72"
                                                    height="72"
                                                    loading="lazy"
                                                    decoding="async"
                                                >
                                            </button>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="producto-detail__panel">
                                <p
                                    class="producto-detail__tag"
                                    style="color: {{ $categoria->color ?? '#e11d48' }}"
                                >
                                    {{ \Illuminate\Support\Str::upper($categoria->nombre) }}
                                </p>
                                <h2 class="producto-detail__title">{{ $producto->nombre }}</h2>

                                @if (filled($producto->descripcion))
                                    <p class="producto-detail__desc">{{ $producto->descripcion }}</p>
                                @endif

                                <dl class="producto-detail__dl">
                                    <div class="producto-detail__dl-row">
                                        <dt>Código</dt>
                                        <dd>{{ $producto->codigo }}</dd>
                                    </div>
                                    <div class="producto-detail__dl-row">
                                        <dt>Tamaño</dt>
                                        <dd>{{ $producto->tamaño }}</dd>
                                    </div>
                                    <div class="producto-detail__dl-row">
                                        <dt>Vida útil</dt>
                                        <dd>{{ $producto->vida_util }}</dd>
                                    </div>
                                </dl>

                                <a href="{{ route('contacto') }}" class="producto-detail__cta">
                                    Consultar
                                </a>
                            </div>
                        </div>
                    </div>

                    @if ($relacionados->isNotEmpty())
                        <section
                            class="productos-producto-page__relacionados"
                            aria-labelledby="productos-relacionados-heading"
                        >
                            <x-card-grid title="Productos relacionados" columns="3">
                                @foreach ($relacionados as $rel)
                                    <x-card-category
                                        href="{{ route('productos.show', [$categoria->id, $rel->id]) }}"
                                        image="{{ $rel->imagen_url }}"
                                        alt="{{ $rel->nombre }}"
                                        title="{{ $rel->nombre }}"
                                        tag="{{ $categoria->nombre }}"
                                        tag_color="{{ $categoria->color }}"
                                        button_text="Ver producto"
                                        text_color="#000000"
                                    />
                                @endforeach
                            </x-card-grid>
                        </section>
                    @endif
                </div>
            </div>
        </div>
    </article>
@endsection

@push('scripts')
    <script>
        (function () {
            var sel = document.getElementById("productos-categoria-jump");
            if (sel) {
                sel.addEventListener("change", function () {
                    var v = this.value;
                    if (v) window.location.href = v;
                });
            }

            var main = document.getElementById("producto-gallery-main");
            if (!main) return;

            document.querySelectorAll(".producto-detail__thumb").forEach(function (btn) {
                btn.addEventListener("click", function () {
                    var url = this.getAttribute("data-full");
                    if (url) main.src = url;

                    document.querySelectorAll(".producto-detail__thumb").forEach(function (b) {
                        b.classList.remove("is-active");
                        b.setAttribute("aria-pressed", "false");
                    });
                    this.classList.add("is-active");
                    this.setAttribute("aria-pressed", "true");
                });
            });
        })();
    </script>
@endpush
