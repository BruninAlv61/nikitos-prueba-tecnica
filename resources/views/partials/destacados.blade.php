{{-- destacados.blade.php --}}

<x-card-grid title="Productos destacados" columns="4">
    @foreach($destacados as $producto)
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
    @endforeach
</x-card-grid>
