{{-- card-category.blade.php --}}

@props(['href', 'color' => null, 'image', 'alt', 'title', 'button_text' => 'Ver todos', 'tag' => '', 'tag_color' => '#000000', 'text_color' => '#ffffff', 'img_size' => null])

<a href="{{ $href }}" 
   class="card-category {{ $color ? '' : 'card-category--no-color' }}" 
   style="background-color: {{ $color ?? '#ffffff' }};">
    
    <img class="card-category__img {{ $img_size === 'cover' ? 'card-category__img--cover' : '' }}" src="{{ $image }}" alt="{{ $alt }}">

    @if($tag)
        <span class="card-category__tag" style="color: {{ $tag_color }}">{{ $tag }}</span>
    @endif

    <h3 class="card-category__h3" style="color: {{ $text_color }}">{{ $title }}</h3>

    <button style="color: {{ $text_color }}" class="card-category__button">{{ $button_text }}</button>
</a>