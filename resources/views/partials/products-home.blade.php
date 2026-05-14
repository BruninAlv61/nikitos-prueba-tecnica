{{-- products-home.blade.php --}}

<x-card-grid title="Linea de productos" columns="4">
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