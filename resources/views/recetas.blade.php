@extends('layouts.app')

@section('content')
    <x-page-hero
        :image="asset('images/recetas.png')"
        title="Recetas"
        heading-id="recetas-hero-titulo"
    />

    <main class="recetas-page">
        @if($recetas->isEmpty())
            <p class="recetas-page__empty">Próximamente tendremos recetas para vos.</p>
        @else
            <x-card-grid title="Nuestras Recetas" columns="4">
                @foreach($recetas as $receta)
                    <x-card-category
                        href="{{ route('recetas.show', $receta->id) }}"
                        image="{{ $receta->imagen_url }}"
                        alt="{{ $receta->titulo }}"
                        title="{{ $receta->titulo }}"
                        tag="{{ $receta->tiempo_preparacion ? 'Prep: ' . $receta->tiempo_preparacion : '' }}"
                        tag_color="#F4A261"
                        button_text="Ver receta"
                        text_color="#000000"
                        img_size="cover"
                    />
                @endforeach
            </x-card-grid>
        @endif
    </main>
@endsection
