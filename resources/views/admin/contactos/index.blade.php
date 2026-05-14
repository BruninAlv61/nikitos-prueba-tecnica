@extends('admin.layout')

@section('contenido')
    <h1>Mensajes de Contacto</h1>

    <div class="table-wrap table-wrap--wide">
    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Tipo</th>
                <th>Remitente</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($contactos as $contacto)
            <tr>
                <td>{{ $contacto->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    @if($contacto->tipo === 'ventas')
                        <span style="background: #e0f2fe; color: #0284c7; padding: 4px 8px; border-radius: 4px; font-size: 0.85em; font-weight: 600;">Ventas</span>
                    @else
                        <span style="background: #fef08a; color: #a16207; padding: 4px 8px; border-radius: 4px; font-size: 0.85em; font-weight: 600;">RRHH</span>
                    @endif
                </td>
                <td>{{ $contacto->tipo === 'ventas' ? $contacto->razon_social : $contacto->nombre }}</td>
                <td>{{ $contacto->email ?? '—' }}</td>
                <td class="cell-actions">
                    <a href="{{ route('admin.contactos.show', $contacto->id) }}" class="btn btn-primary">Ver</a>
                    <form action="{{ route('admin.contactos.destroy', $contacto->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('¿Eliminar este mensaje?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center;">No hay mensajes recibidos.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    </div>
@endsection
