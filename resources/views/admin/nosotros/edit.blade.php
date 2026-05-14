@extends('admin.layout')

@section('contenido')
    <nav class="admin-breadcrumb" aria-label="Migas de pan">
        <a href="{{ route('admin.contenido.index') }}">Contenido</a>
        <span aria-hidden="true"> / </span>
        <span style="color:#333;">Nosotros</span>
    </nav>
    <h1>Nosotros</h1>
    <p class="admin-lead">
        Editá los textos de la página pública. Las imágenes son fijas en el sitio; solo se administran los títulos y cuerpos.
        Usá una línea en blanco entre párrafos para separar bloques.
    </p>
    <div class="form-card form-card--wide">
        <form action="{{ route('admin.nosotros.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="hero_titulo">Título del banner (hero)</label>
                <input id="hero_titulo" type="text" name="hero_titulo" value="{{ old('hero_titulo', $contenido->hero_titulo) }}" maxlength="120" required autocomplete="off">
                @error('hero_titulo')
                    <span class="form-error" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <hr style="border:none;border-top:1px solid #eee;margin:20px 0;">

            <div class="form-group">
                <label for="seccion_1_titulo">Sección 1 — Título</label>
                <input id="seccion_1_titulo" type="text" name="seccion_1_titulo" value="{{ old('seccion_1_titulo', $contenido->seccion_1_titulo) }}" maxlength="255" required autocomplete="off">
                @error('seccion_1_titulo')
                    <span class="form-error" role="alert">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="seccion_1_cuerpo">Sección 1 — Texto (imagen: nos1.png)</label>
                <textarea id="seccion_1_cuerpo" name="seccion_1_cuerpo" rows="8" maxlength="20000" required>{{ old('seccion_1_cuerpo', $contenido->seccion_1_cuerpo) }}</textarea>
                @error('seccion_1_cuerpo')
                    <span class="form-error" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <hr style="border:none;border-top:1px solid #eee;margin:20px 0;">

            <div class="form-group">
                <label for="seccion_2_titulo">Sección 2 — Título</label>
                <input id="seccion_2_titulo" type="text" name="seccion_2_titulo" value="{{ old('seccion_2_titulo', $contenido->seccion_2_titulo) }}" maxlength="255" required autocomplete="off">
                @error('seccion_2_titulo')
                    <span class="form-error" role="alert">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="seccion_2_cuerpo">Sección 2 — Texto (imagen: nos2.png)</label>
                <textarea id="seccion_2_cuerpo" name="seccion_2_cuerpo" rows="8" maxlength="20000" required>{{ old('seccion_2_cuerpo', $contenido->seccion_2_cuerpo) }}</textarea>
                @error('seccion_2_cuerpo')
                    <span class="form-error" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <hr style="border:none;border-top:1px solid #eee;margin:20px 0;">

            <div class="form-group">
                <label for="seccion_3_titulo">Sección 3 — Título</label>
                <input id="seccion_3_titulo" type="text" name="seccion_3_titulo" value="{{ old('seccion_3_titulo', $contenido->seccion_3_titulo) }}" maxlength="255" required autocomplete="off">
                @error('seccion_3_titulo')
                    <span class="form-error" role="alert">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="seccion_3_cuerpo">Sección 3 — Texto (imagen: nos3.png)</label>
                <textarea id="seccion_3_cuerpo" name="seccion_3_cuerpo" rows="6" maxlength="20000" required>{{ old('seccion_3_cuerpo', $contenido->seccion_3_cuerpo) }}</textarea>
                @error('seccion_3_cuerpo')
                    <span class="form-error" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <hr style="border:none;border-top:1px solid #eee;margin:20px 0;">

            <div class="form-group">
                <label for="seccion_4_titulo">Sección 4 — Título</label>
                <input id="seccion_4_titulo" type="text" name="seccion_4_titulo" value="{{ old('seccion_4_titulo', $contenido->seccion_4_titulo) }}" maxlength="255" required autocomplete="off">
                @error('seccion_4_titulo')
                    <span class="form-error" role="alert">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="seccion_4_cuerpo">Sección 4 — Texto (imagen: nos4.png)</label>
                <textarea id="seccion_4_cuerpo" name="seccion_4_cuerpo" rows="6" maxlength="20000" required>{{ old('seccion_4_cuerpo', $contenido->seccion_4_cuerpo) }}</textarea>
                @error('seccion_4_cuerpo')
                    <span class="form-error" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                <a href="{{ route('admin.contenido.index') }}" class="btn btn-secondary">Volver a Contenido</a>
                <a href="{{ route('nosotros') }}" class="btn btn-secondary" target="_blank" rel="noopener">Ver página pública</a>
            </div>
        </form>
    </div>
@endsection
