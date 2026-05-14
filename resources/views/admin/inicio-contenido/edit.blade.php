@extends('admin.layout')

@section('contenido')
    <div class="page-header">
        <h1>Editar Contenido - Inicio</h1>
        <a href="{{ route('admin.contenido.index') }}" class="btn btn-secondary">Volver al listado</a>
    </div>

    <div class="form-card form-card--wide">
        <form action="{{ route('admin.inicio-contenido.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <h2 style="margin-bottom: 16px; font-size: 18px; color: #F4A261;">Sección Principal (Hero)</h2>
            <div class="form-group">
                <label for="hero_titulo">Título (h1)</label>
                <input id="hero_titulo" type="text" name="hero_titulo" value="{{ old('hero_titulo', $contenido->hero_titulo) }}" required>
                @error('hero_titulo')
                    <div style="color: red; font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="hero_texto">Texto/Párrafo</label>
                <textarea id="hero_texto" name="hero_texto" rows="3" required>{{ old('hero_texto', $contenido->hero_texto) }}</textarea>
                @error('hero_texto')
                    <div style="color: red; font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <hr style="margin: 32px 0; border: none; border-top: 1px solid #ddd;">

            <h2 style="margin-bottom: 16px; font-size: 18px; color: #F4A261;">Sección Nosotros (Home)</h2>
            <div class="form-group">
                <label for="about_us_texto">Texto descriptivo</label>
                <textarea id="about_us_texto" name="about_us_texto" rows="5" required>{{ old('about_us_texto', $contenido->about_us_texto) }}</textarea>
                @error('about_us_texto')
                    <div style="color: red; font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions" style="margin-top: 1.5rem;">
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </div>
        </form>
    </div>
@endsection
