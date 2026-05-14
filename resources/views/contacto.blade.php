@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/leaflet/leaflet.css') }}">
@endpush

@php
    $contactoMapCfg = [
        'lat'     => -34.6619,
        'lng'     => -58.7293,
        'zoom'    => 16,
        'logoUrl' => asset('images/logo.png'),
        'title'   => 'Nikitos Snacks',
        'line1'   => 'Av. Otero y Gibraltar - Km 32 CP.1761',
        'line2'   => 'Pontevedra, Merlo, Buenos Aires, Argentina',
    ];
@endphp


@section('content')
<div class="contacto-wrapper">
    <x-page-hero
        :image="asset('images/contacto.png')"
        title="Contacto"
        heading-id="contacto-hero-titulo"
        align="center"
    />

    <div class="contacto-page">

    @if(session('success'))
        <div class="contacto-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="contacto-error contacto-error--banner" role="alert">
            <p>Hay datos incompletos o inválidos. Revisá los mensajes bajo cada campo.</p>
        </div>
    @endif

    <div class="contacto-layout">
        {{-- Tabs --}}
        <aside class="contacto-tabs">
            <button class="contacto-tab {{ old('tipo', 'ventas') === 'ventas' ? 'active' : '' }}" onclick="switchTab('ventas', this)">
                Ventas <span>›</span>
            </button>
            <button class="contacto-tab {{ old('tipo') === 'rrhh' ? 'active' : '' }}" onclick="switchTab('rrhh', this)">
                RRHH <span>›</span>
            </button>
        </aside>

        {{-- Formulario Ventas --}}
        <div id="tab-ventas" class="contacto-form-wrap" style="display: {{ old('tipo', 'ventas') === 'ventas' ? 'block' : 'none' }}">
            <form action="{{ route('contacto.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="tipo" value="ventas">

                <div class="contacto-grid">
                    <div class="form-group">
                        <label for="ventas_razon_social">Razón social*</label>
                        <input id="ventas_razon_social" type="text" name="razon_social" value="{{ old('razon_social') }}" maxlength="255" required autocomplete="organization">
                        @error('razon_social')<span class="contacto-field-error" role="alert">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="ventas_cuit">CUIT*</label>
                        <input id="ventas_cuit" type="text" name="cuit" value="{{ old('cuit') }}" maxlength="20" required autocomplete="off">
                        @error('cuit')<span class="contacto-field-error" role="alert">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="ventas_tipo_negocio">Tipo de Negocio*</label>
                        <input id="ventas_tipo_negocio" type="text" name="tipo_negocio" value="{{ old('tipo_negocio') }}" maxlength="255" required autocomplete="off">
                        @error('tipo_negocio')<span class="contacto-field-error" role="alert">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="ventas_trayectoria">Trayectoria en el Mercado</label>
                        <input id="ventas_trayectoria" type="text" name="trayectoria" value="{{ old('trayectoria') }}" maxlength="255" autocomplete="off">
                        @error('trayectoria')<span class="contacto-field-error" role="alert">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="ventas_direccion">Dirección*</label>
                        <input id="ventas_direccion" type="text" name="direccion" value="{{ old('direccion') }}" maxlength="255" required autocomplete="street-address">
                        @error('direccion')<span class="contacto-field-error" role="alert">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="ventas_localidad">Localidad*</label>
                        <input id="ventas_localidad" type="text" name="localidad" value="{{ old('localidad') }}" maxlength="255" required autocomplete="address-level2">
                        @error('localidad')<span class="contacto-field-error" role="alert">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="ventas_telefono">Teléfono*</label>
                        <input id="ventas_telefono" type="text" name="telefono" value="{{ old('telefono') }}" maxlength="50" required autocomplete="tel">
                        @error('telefono')<span class="contacto-field-error" role="alert">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="ventas_celular">Celular*</label>
                        <input id="ventas_celular" type="text" name="celular" value="{{ old('celular') }}" maxlength="50" required autocomplete="tel">
                        @error('celular')<span class="contacto-field-error" role="alert">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="ventas_horario">Horario de atención*</label>
                        <input id="ventas_horario" type="text" name="horario_atencion" value="{{ old('horario_atencion') }}" maxlength="100" required autocomplete="off">
                        @error('horario_atencion')<span class="contacto-field-error" role="alert">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="ventas_email">Email*</label>
                        <input id="ventas_email" type="email" name="email" value="{{ old('email') }}" maxlength="255" required autocomplete="email">
                        @error('email')<span class="contacto-field-error" role="alert">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group form-group--full">
                        <label for="ventas_observaciones">Observaciones*</label>
                        <textarea id="ventas_observaciones" name="observaciones" rows="4" maxlength="10000" required>{{ old('observaciones') }}</textarea>
                        @error('observaciones')<span class="contacto-field-error" role="alert">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="contacto-footer">
                    <span>*Campos obligatorios</span>
                    <button type="submit" class="btn-consultar">Enviar consulta</button>
                </div>
            </form>
        </div>

        {{-- Formulario RRHH --}}
        <div id="tab-rrhh" class="contacto-form-wrap" style="display: {{ old('tipo') === 'rrhh' ? 'block' : 'none' }}">
            <form action="{{ route('contacto.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="tipo" value="rrhh">

                <div class="contacto-grid">
                    <div class="form-group">
                        <label for="rrhh_nombre">Nombre*</label>
                        <input id="rrhh_nombre" type="text" name="nombre" value="{{ old('nombre') }}" maxlength="255" required autocomplete="name">
                        @error('nombre')<span class="contacto-field-error" role="alert">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="rrhh_sexo">Sexo*</label>
                        <input id="rrhh_sexo" type="text" name="sexo" value="{{ old('sexo') }}" maxlength="40" required list="rrhh_sexo_opciones" autocomplete="sex">
                        <datalist id="rrhh_sexo_opciones">
                            <option value="Femenino"></option>
                            <option value="Masculino"></option>
                            <option value="Otro"></option>
                        </datalist>
                        @error('sexo')<span class="contacto-field-error" role="alert">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="rrhh_dni">DNI*</label>
                        <input id="rrhh_dni" type="text" name="dni" value="{{ old('dni') }}" maxlength="20" required inputmode="numeric" autocomplete="off">
                        @error('dni')<span class="contacto-field-error" role="alert">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="rrhh_fecha_nacimiento">Fecha de nacimiento*</label>
                        <input id="rrhh_fecha_nacimiento" type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" max="{{ now()->subDay()->format('Y-m-d') }}" min="1900-01-01" required>
                        @error('fecha_nacimiento')<span class="contacto-field-error" role="alert">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="rrhh_direccion">Dirección*</label>
                        <input id="rrhh_direccion" type="text" name="direccion" value="{{ old('direccion') }}" maxlength="255" required autocomplete="street-address">
                        @error('direccion')<span class="contacto-field-error" role="alert">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="rrhh_localidad">Localidad*</label>
                        <input id="rrhh_localidad" type="text" name="localidad" value="{{ old('localidad') }}" maxlength="255" required autocomplete="address-level2">
                        @error('localidad')<span class="contacto-field-error" role="alert">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="rrhh_telefono">Teléfono*</label>
                        <input id="rrhh_telefono" type="text" name="telefono" value="{{ old('telefono') }}" maxlength="50" required autocomplete="tel">
                        @error('telefono')<span class="contacto-field-error" role="alert">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="rrhh_email">Email</label>
                        <input id="rrhh_email" type="email" name="email" value="{{ old('email') }}" maxlength="255" autocomplete="email">
                        @error('email')<span class="contacto-field-error" role="alert">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="rrhh_puesto">Puesto al que aspira*</label>
                        <select id="rrhh_puesto" name="puesto_aspira" required>
                            <option value="" disabled @selected(old('puesto_aspira') === null || old('puesto_aspira') === '')>Seleccionar</option>
                            <option value="Ventas" @selected(old('puesto_aspira') === 'Ventas')>Ventas</option>
                            <option value="Producción" @selected(old('puesto_aspira') === 'Producción')>Producción</option>
                            <option value="Administración" @selected(old('puesto_aspira') === 'Administración')>Administración</option>
                            <option value="Logística" @selected(old('puesto_aspira') === 'Logística')>Logística</option>
                        </select>
                        @error('puesto_aspira')<span class="contacto-field-error" role="alert">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="rrhh_cv">Subir CV</label>
                        <input id="rrhh_cv" type="file" name="cv" accept=".pdf,.doc,.docx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                        @error('cv')<span class="contacto-field-error" role="alert">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="contacto-footer">
                    <span>*Campos obligatorios</span>
                    <button type="submit" class="btn-consultar">Postularme</button>
                </div>
            </form>
        </div>
    </div>
    </div>

    @include('partials.contacto-datos-mapa')
</div>

<script>
function switchTab(tab, el) {
    document.querySelectorAll('.contacto-form-wrap').forEach(f => f.style.display = 'none');
    document.querySelectorAll('.contacto-tab').forEach(t => t.classList.remove('active'));
    document.getElementById('tab-' + tab).style.display = 'block';
    el.classList.add('active');
}
</script>
@endsection

@push('scripts')
    <script>window.__CONTACTO_MAP__ = @json($contactoMapCfg);</script>
    <script src="{{ asset('vendor/leaflet/leaflet.js') }}"></script>
    <script src="{{ asset('js/nikitos-maps.js') }}"></script>
@endpush