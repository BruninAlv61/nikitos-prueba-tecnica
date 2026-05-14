@extends('admin.layout')

@section('contenido')
    <h1>Nueva Receta</h1>
    <div class="form-card form-card--wide">
        <form action="{{ route('admin.recetas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="receta_titulo">Título</label>
                <input id="receta_titulo" type="text" name="titulo" value="{{ old('titulo') }}" maxlength="255" required autocomplete="off">
                @error('titulo')<span class="form-error" role="alert">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="receta_imagen">Imagen</label>
                <input id="receta_imagen" type="file" name="imagen" accept="image/jpeg,image/png,image/webp,image/gif">
                @error('imagen')<span class="form-error" role="alert">{{ $message }}</span>@enderror
            </div>

            <div class="admin-form-grid">
                <div class="form-group">
                    <label for="receta_tiempo">Tiempo de preparación</label>
                    <input id="receta_tiempo" type="text" name="tiempo_preparacion" value="{{ old('tiempo_preparacion') }}" maxlength="100" placeholder="Ej: 30 minutos" autocomplete="off">
                    @error('tiempo_preparacion')<span class="form-error" role="alert">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label for="receta_porciones">Porciones</label>
                    <input id="receta_porciones" type="number" name="porciones" value="{{ old('porciones', 1) }}" min="1" max="500">
                    @error('porciones')<span class="form-error" role="alert">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="form-group">
                <label>Ingredientes</label>
                <p style="font-size:12px;color:#888;margin-bottom:8px;">Un ingrediente por línea.</p>
                <div id="ingredientes-lista" style="display:flex;flex-direction:column;gap:8px;">
                    @foreach(old('ingredientes', ['']) as $ing)
                        <div class="admin-field-row">
                            <input type="text" name="ingredientes[]" value="{{ $ing }}" maxlength="500"
                                   placeholder="Ej: 1 bolsa de papas fritas Nikitos">
                            <button type="button" onclick="this.parentElement.remove()"
                                    class="btn btn-danger" style="padding:6px 10px;">✕</button>
                        </div>
                    @endforeach
                </div>
                @error('ingredientes')<span class="form-error" role="alert">{{ $message }}</span>@enderror
                @error('ingredientes.*')<span class="form-error" role="alert">{{ $message }}</span>@enderror
                <button type="button" onclick="agregarCampo('ingredientes-lista','ingredientes[]','Ej: 1 taza de agua')"
                        class="btn btn-secondary" style="margin-top:8px;">+ Agregar ingrediente</button>
            </div>

            <div class="form-group">
                <label>Pasos de preparación</label>
                <p style="font-size:12px;color:#888;margin-bottom:8px;">Un paso por campo, en orden.</p>
                <div id="pasos-lista" style="display:flex;flex-direction:column;gap:8px;">
                    @foreach(old('pasos', ['']) as $paso)
                        <div class="admin-field-row admin-field-row--start">
                            <textarea name="pasos[]" rows="2" maxlength="5000"
                                      placeholder="Describí el paso…">{{ $paso }}</textarea>
                            <button type="button" onclick="this.parentElement.remove()"
                                    class="btn btn-danger" style="padding:6px 10px;">✕</button>
                        </div>
                    @endforeach
                </div>
                @error('pasos')<span class="form-error" role="alert">{{ $message }}</span>@enderror
                @error('pasos.*')<span class="form-error" role="alert">{{ $message }}</span>@enderror
                <button type="button" onclick="agregarPaso('pasos-lista')"
                        class="btn btn-secondary" style="margin-top:8px;">+ Agregar paso</button>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('admin.recetas.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>

    <script>
        function agregarCampo(listaId, name, placeholder) {
            const lista = document.getElementById(listaId);
            const div = document.createElement('div');
            div.className = 'admin-field-row';
            div.innerHTML = '<input type="text" name="' + name + '" maxlength="500" placeholder="' + placeholder.replace(/"/g, '&quot;') + '">' +
                '<button type="button" onclick="this.parentElement.remove()" class="btn btn-danger" style="padding:6px 10px;">✕</button>';
            lista.appendChild(div);
        }
        function agregarPaso(listaId) {
            const lista = document.getElementById(listaId);
            const div = document.createElement('div');
            div.className = 'admin-field-row admin-field-row--start';
            div.innerHTML = '<textarea name="pasos[]" rows="2" maxlength="5000" placeholder="Describí el paso…"></textarea>' +
                '<button type="button" onclick="this.parentElement.remove()" class="btn btn-danger" style="padding:6px 10px;">✕</button>';
            lista.appendChild(div);
        }
    </script>
@endsection
