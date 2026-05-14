@extends('admin.layout')

@section('contenido')
    <div class="page-header">
        <h1>Recetas</h1>
        <a href="{{ route('admin.recetas.create') }}" class="btn btn-primary">+ Nueva receta</a>
    </div>

    @if($recetas->isEmpty())
        <p class="admin-lead">No hay recetas todavía.</p>
    @else
        <div class="table-wrap table-wrap--wide">
        <table>
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Título</th>
                    <th>Tiempo prep.</th>
                    <th>Porciones</th>
                    <th>Ingredientes</th>
                    <th>Pasos</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recetas as $receta)
                    <tr>
                        <td>
                            <img src="{{ $receta->imagen_url }}" class="thumb" alt="{{ $receta->titulo }}">
                        </td>
                        <td>{{ $receta->titulo }}</td>
                        <td>{{ $receta->tiempo_preparacion ?? '—' }}</td>
                        <td>{{ $receta->porciones }}</td>
                        <td>{{ count($receta->ingredientes ?? []) }}</td>
                        <td>{{ count($receta->pasos ?? []) }}</td>
                        <td class="cell-actions">
                            <a href="{{ route('admin.recetas.edit', $receta->id) }}" class="btn btn-primary">Editar</a>
                            <form action="{{ route('admin.recetas.destroy', $receta->id) }}" method="POST"
                                  onsubmit="return confirm('¿Eliminar receta?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    @endif
@endsection
