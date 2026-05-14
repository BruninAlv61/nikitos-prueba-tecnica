@extends('layouts.app')

@php
    $catalogoHref = $categoria->catalogo
        ? (str_starts_with($categoria->catalogo, 'http')
            ? $categoria->catalogo
            : asset($categoria->catalogo))
        : asset('images/Catálogo 2026 para la pagina web.pdf');
    $catalogoEsExterno = str_starts_with((string) $catalogoHref, 'http://')
        || str_starts_with((string) $catalogoHref, 'https://');
@endphp

@section('content')
    <article class="productos-categoria-page">
        <x-page-hero
            :image="asset('images/productos.png')"
            title="Productos"
            heading-id="productos-categoria-hero-heading"
        />

        <div class="productos-categoria-page__shell">
            <div class="productos-categoria-page__toolbar">
                <a
                    href="{{ $catalogoHref }}"
                    class="productos-categoria-page__catalog"
                    @if (! $catalogoEsExterno) download @endif
                >
                    Descargar catálogo
                </a>
            </div>

            <h2 id="productos-categoria-listado" class="sr-only">
                {{ $categoria->nombre }}
            </h2>

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

                <aside class="productos-categoria-page__sidebar" aria-labelledby="productos-categoria-nav-heading">
                    <h3 id="productos-categoria-nav-heading" class="sr-only">
                        Categorías de productos
                    </h3>
                    <ul class="productos-categoria-page__sidebar-nav">
                        @foreach ($categorias as $cat)
                            <li class="productos-categoria-page__sidebar-item">
                                <a
                                    href="{{ route('productos.categoria', $cat->id) }}"
                                    class="productos-categoria-page__sidebar-link @if ($cat->id === $categoria->id) productos-categoria-page__sidebar-link--current @endif"
                                    @if ($cat->id === $categoria->id) aria-current="page" @endif
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
                    @if ($categoria->productos->isEmpty())
                        <p class="productos-categoria-page__empty" role="status">
                            No hay ningun producto para esta categoria
                        </p>
                    @else
                        <x-card-grid :title="$categoria->nombre" columns="3">
                            @foreach ($categoria->productos as $producto)
                                <x-card-category
                                    href="{{ route('productos.show', [$categoria->id, $producto->id]) }}"
                                    image="{{ $producto->imagen_url }}"
                                    alt="{{ $producto->nombre }}"
                                    title="{{ $producto->nombre }}"
                                    tag="{{ $categoria->nombre }}"
                                    tag_color="{{ $categoria->color }}"
                                    button_text="Ver producto"
                                    text_color="#000000"
                                />
                            @endforeach
                        </x-card-grid>
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
            if (!sel) return;
            sel.addEventListener("change", function () {
                var v = this.value;
                if (v) window.location.href = v;
            });
        })();
    </script>
@endpush
