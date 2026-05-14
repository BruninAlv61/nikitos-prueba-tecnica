{{-- products-home.blade.php --}}

<x-card-grid title="Linea de productos" columns="4">
    @forelse($categorias as $categoria)
        <x-card-category
            href="{{ route('productos.categoria', $categoria->id) }}"
            image="{{ $categoria->imagen_url }}"
            alt="{{ $categoria->nombre }}"
            title="{{ $categoria->nombre }}"
            color="{{ $categoria->color }}"
            button_text="Ver todos"
        />
    @empty
        <p style="color:#888;grid-column:1/-1;text-align:center;">No hay categorías</p>
    @endforelse
</x-card-grid>