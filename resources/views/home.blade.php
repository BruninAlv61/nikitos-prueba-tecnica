{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('content')
    <main class="main__home">
        @include('partials.hero')
        @include('partials.about-us')
        @include('partials.products-home')
        @include('partials.destacados')
        @include('partials.recipes-home')
    </main>
@endsection


{{-- @foreach($categorias as $categoria)
            <p>{{ $categoria->nombre }}</p>
        @endforeach --}}