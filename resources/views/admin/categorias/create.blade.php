@extends('admin.layout')

@section('contenido')
    <h1>Nueva Categoría</h1>
    <div class="form-card">
        <form action="{{ route('admin.categorias.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="cat_nombre">Nombre</label>
                <input id="cat_nombre" type="text" name="nombre" value="{{ old('nombre') }}" maxlength="255" required autocomplete="off">
                @error('nombre')<span class="form-error" role="alert">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="cat_color">Color</label>
                <input id="cat_color" type="color" name="color" value="{{ old('color', '#F4A261') }}">
                @error('color')<span class="form-error" role="alert">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="cat_imagen">Imagen</label>
                <input id="cat_imagen" type="file" name="imagen" accept="image/jpeg,image/png,image/webp,image/gif">
                @error('imagen')<span class="form-error" role="alert">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="cat_catalogo">Catálogo (PDF)</label>
                <input id="cat_catalogo" type="file" name="catalogo" accept=".pdf,application/pdf">
                @error('catalogo')<span class="form-error" role="alert">{{ $message }}</span>@enderror
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('admin.categorias.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
