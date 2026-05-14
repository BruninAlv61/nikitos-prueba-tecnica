{{-- destacados.blade.php --}}

<x-card-grid title="Productos destacados" columns="4">
    @forelse($destacados as $producto)
        <x-card-category
            href="{{ route('productos.show', [$producto->categoria->id, $producto->id]) }}"
            image="{{ $producto->imagen_url }}"
            alt="{{ $producto->nombre }}"
            title="{{ $producto->nombre }}"
            tag="{{ $producto->categoria->nombre }}"
            tag_color="{{ $producto->categoria->color }}"
            button_text="Ver producto"
            text_color="#000000"
        />
    @empty
        <p style="color:#888;grid-column:1/-1;text-align:center;">No hay productos</p>
    @endforelse
</x-card-grid>
