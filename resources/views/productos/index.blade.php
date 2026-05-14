@extends('layouts.app')

@section('content')
    <div class="productos-page">
        <x-page-hero
            :image="asset('images/productos.png')"
            title="Productos"
            heading-id="productos-hero-titulo"
        />
        <x-card-grid title="Línea de productos" columns="4">
            @foreach($categorias as $categoria)
                <x-card-category
                    href="{{ route('productos.categoria', $categoria->id) }}"
                    image="{{ $categoria->imagen_url }}"
                    alt="{{ $categoria->nombre }}"
                    title="{{ $categoria->nombre }}"
                    color="{{ $categoria->color }}"
                    button_text="Ver todos"
                />
            @endforeach
        </x-card-grid>
    </div>
@endsection