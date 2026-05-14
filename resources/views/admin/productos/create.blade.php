@extends('admin.layout')

@section('contenido')
    <h1>Nuevo Producto</h1>
    <div class="form-card">
        <form action="{{ route('admin.productos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="producto_nombre">Nombre</label>
                <input id="producto_nombre" type="text" name="nombre" value="{{ old('nombre') }}" maxlength="255" required autocomplete="off">
                @error('nombre')<span class="form-error" role="alert">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="producto_codigo">Código</label>
                <input id="producto_codigo" type="text" name="codigo" value="{{ old('codigo') }}" maxlength="50" required autocomplete="off">
                @error('codigo')<span class="form-error" role="alert">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="producto_tamaño">Tamaño</label>
                <input id="producto_tamaño" type="text" name="tamaño" value="{{ old('tamaño') }}" maxlength="100" autocomplete="off">
                @error('tamaño')<span class="form-error" role="alert">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="producto_vida_util">Vida útil</label>
                <input id="producto_vida_util" type="text" name="vida_util" value="{{ old('vida_util') }}" maxlength="100" autocomplete="off">
                @error('vida_util')<span class="form-error" role="alert">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="producto_categoria_id">Categoría</label>
                <select id="producto_categoria_id" name="categoria_id" required>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}" @selected(old('categoria_id', $categorias->first()->id) == $categoria->id)>{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
                @error('categoria_id')<span class="form-error" role="alert">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="producto_imagen">Imagen</label>
                <input id="producto_imagen" type="file" name="imagen" accept="image/jpeg,image/png,image/webp,image/gif">
                @error('imagen')<span class="form-error" role="alert">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <input type="hidden" name="destacado" value="0">
                <label>
                    <input type="checkbox" name="destacado" value="1" @checked(old('destacado'))>
                    Producto destacado
                </label>
                @error('destacado')<span class="form-error" role="alert">{{ $message }}</span>@enderror
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
