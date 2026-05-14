@extends('admin.layout')

@section('contenido')
    <h1>Contenido</h1>
    <p class="admin-lead">
        Elegí qué textos del sitio querés editar. Acá se irán sumando más secciones a medida que el administrador lo permita.
    </p>

    <div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>Sección</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Inicio (Home)</strong></td>
                <td>Textos de la página de inicio (Hero y sección Nosotros).</td>
                <td>
                    <a href="{{ route('admin.inicio-contenido.edit') }}" class="btn btn-primary">Editar</a>
                </td>
            </tr>
            <tr>
                <td><strong>Nosotros</strong></td>
                <td>Textos de la página pública Nosotros (banner y secciones).</td>
                <td>
                    <a href="{{ route('admin.nosotros.edit') }}" class="btn btn-primary">Editar</a>
                </td>
            </tr>
        </tbody>
    </table>
    </div>
@endsection
