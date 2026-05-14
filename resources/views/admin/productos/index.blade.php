@extends('admin.layout')

@section('contenido')
    <div class="page-header">
        <h1>Productos</h1>
        <a href="{{ route('admin.productos.create') }}" class="btn btn-primary">+ Nuevo producto</a>
    </div>

    <div class="table-wrap table-wrap--wide">
    <table>
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Código</th>
                <th>Categoría</th>
                <th>Destacado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
            <tr>
                <td>
                    <img class="thumb" src="{{ $producto->imagen_url }}" alt="">
                </td>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->codigo }}</td>
                <td>{{ $producto->categoria ? $producto->categoria->nombre : '—' }}</td>
                <td>{{ $producto->destacado ? 'Sí' : 'No' }}</td>
                <td class="cell-actions">
                    <a href="{{ route('admin.productos.edit', $producto->id) }}" class="btn btn-secondary">Editar</a>
                    <form action="{{ route('admin.productos.destroy', $producto->id) }}" method="POST">
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