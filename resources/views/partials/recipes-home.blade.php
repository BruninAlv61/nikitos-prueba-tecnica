{{-- recipes-home.blade.php --}}

<x-card-grid title="Recetas" columns="3">
    @forelse($recetasHome as $receta)
        <x-card-category
            href="{{ route('recetas.show', $receta->id) }}"
            image="{{ $receta->imagen_url }}"
            alt="{{ $receta->titulo }}"
            title="{{ $receta->titulo }}"
            button_text="Ver receta"
            text_color="#000000"
            img_size="cover"
        />
    @empty
        <p style="color:#888;grid-column:1/-1;text-align:center;">No hay recetas</p>
    @endforelse
</x-card-grid>
