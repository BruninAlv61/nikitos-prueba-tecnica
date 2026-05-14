@extends('admin.layout')

@section('contenido')
    <div class="page-header">
        <h1>Categorías</h1>
        <a href="{{ route('admin.categorias.create') }}" class="btn btn-primary">+ Nueva categoría</a>
    </div>

    <div class="table-wrap table-wrap--wide">
    <table>
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Color</th>
                <th>Productos</th>
                <th>Catálogo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categorias as $categoria)
            <tr>
                <td>
                    @if($categoria->imagen)
                        <img class="thumb" src="{{ $categoria->imagen_url }}" alt="">
                    @else
                        —
                    @endif
                </td>
                <td>{{ $categoria->nombre }}</td>
                <td>
                    <span style="display:inline-block; width:20px; height:20px; border-radius:4px; background:{{ $categoria->color }}"></span>
                    {{ $categoria->color }}
                </td>
                <td>{{ $categoria->productos_count }}</td>
                <td>{{ $categoria->catalogo ? 'Sí' : 'No' }}</td>
                <td class="cell-actions">
                    <a href="{{ route('admin.categorias.edit', $categoria->id) }}" class="btn btn-secondary">Editar</a>
                    <form action="{{ route('admin.categorias.destroy', $categoria->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('¿Eliminar?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
@endsection