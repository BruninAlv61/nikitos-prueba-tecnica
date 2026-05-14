@props(['href', 'active' => ''])
<li>
    <a href="{{ $href }}" class="{{ request()->routeIs($active) ? 'link--active' : '' }}">
        {{ $slot }}
    </a>
</li>