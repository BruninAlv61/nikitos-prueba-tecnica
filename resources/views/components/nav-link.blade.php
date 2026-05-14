@props(['href'])

@php
    $isActive = request()->url() === $href || request()->is(ltrim(parse_url($href, PHP_URL_PATH), '/'));
    $classes = $isActive ? 'link--active' : '';
@endphp

<li>
    <a {{ $attributes->merge(['href' => $href, 'class' => $classes]) }}
       @if($isActive) aria-current="page" @endif>
        {{ $slot }}
    </a>
</li>
