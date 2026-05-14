@extends('admin.layout')

@section('contenido')
    <h1>Detalle del Mensaje</h1>

    <div class="form-card" style="margin-top: 1.25rem;">
        <div style="margin-bottom: 1.25rem;">
            <strong>Fecha de envío:</strong> {{ $contacto->created_at->format('d/m/Y H:i:s') }} <br>
            <strong>Tipo de consulta:</strong>
            <span style="background: {{ $contacto->tipo === 'ventas' ? '#e0f2fe' : '#fef08a' }}; color: {{ $contacto->tipo === 'ventas' ? '#0284c7' : '#a16207' }}; padding: 4px 8px; border-radius: 4px; font-size: 0.85em; font-weight: 600; text-transform: uppercase;">
                {{ $contacto->tipo }}
            </span>
        </div>

        <hr style="margin: 1.25rem 0; border: none; border-top: 1px solid #ddd;">

        @if($contacto->tipo === 'ventas')
            <h3>Datos de la Empresa</h3>
            <div class="admin-detail-grid">
                <div><strong>Razón Social:</strong> {{ $contacto->razon_social }}</div>
                <div><strong>CUIT:</strong> {{ $contacto->cuit }}</div>
                <div><strong>Tipo de Negocio:</strong> {{ $contacto->tipo_negocio }}</div>
                <div><strong>Trayectoria:</strong> {{ $contacto->trayectoria ?? 'N/A' }}</div>
            </div>

            <h3>Datos de Contacto</h3>
            <div class="admin-detail-grid">
                <div><strong>Dirección:</strong> {{ $contacto->direccion }}</div>
                <div><strong>Localidad:</strong> {{ $contacto->localidad }}</div>
                <div><strong>Teléfono:</strong> {{ $contacto->telefono }}</div>
                <div><strong>Celular:</strong> {{ $contacto->celular }}</div>
                <div><strong>Horario de Atención:</strong> {{ $contacto->horario_atencion }}</div>
                <div><strong>Email:</strong> <a href="mailto:{{ $contacto->email }}">{{ $contacto->email }}</a></div>
            </div>

            <h3>Mensaje / Observaciones</h3>
            <div style="background: #f9fafb; padding: 1rem; border-radius: 0.5rem; border: 1px solid #e5e7eb;">
                {!! nl2br(e($contacto->observaciones)) !!}
            </div>

        @else
            <h3>Datos Personales</h3>
            <div class="admin-detail-grid">
                <div><strong>Nombre y Apellido:</strong> {{ $contacto->nombre }}</div>
                <div><strong>Sexo:</strong> {{ $contacto->sexo }}</div>
                <div><strong>DNI:</strong> {{ $contacto->dni }}</div>
                <div><strong>Fecha de Nacimiento:</strong> {{ \Carbon\Carbon::parse($contacto->fecha_nacimiento)->format('d/m/Y') }}</div>
            </div>

            <h3>Datos de Contacto</h3>
            <div class="admin-detail-grid">
                <div><strong>Dirección:</strong> {{ $contacto->direccion }}</div>
                <div><strong>Localidad:</strong> {{ $contacto->localidad }}</div>
                <div><strong>Teléfono:</strong> {{ $contacto->telefono }}</div>
                <div><strong>Email:</strong> @if($contacto->email) <a href="mailto:{{ $contacto->email }}">{{ $contacto->email }}</a> @else N/A @endif</div>
            </div>

            <h3>Información Laboral</h3>
            <div class="admin-detail-grid">
                <div><strong>Puesto al que aspira:</strong> {{ $contacto->puesto_aspira }}</div>
                <div>
                    <strong>Curriculum Vitae:</strong>
                    @if($contacto->cv)
                        <a href="{{ asset('storage/' . $contacto->cv) }}" target="_blank" class="btn btn-primary" style="padding: 4px 12px; font-size: 0.9em;">Descargar CV</a>
                    @else
                        No adjuntó
                    @endif
                </div>
            </div>
        @endif

        <div class="form-actions" style="margin-top: 1.5rem;">
            <a href="{{ route('admin.contactos.index') }}" class="btn btn-secondary">Volver al listado</a>
        </div>
    </div>
@endsection
