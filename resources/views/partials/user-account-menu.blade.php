@php
    $suffix = $menuSuffix ?? 'main';
    $user = auth()->user();
    $displayName = $user->name;
    if (! empty($user->lastname)) {
        $displayName .= ' '.mb_strtoupper(mb_substr($user->lastname, 0, 1)).'.';
    }
@endphp

<div class="header-user-menu header-user-menu--{{ $suffix }}" data-user-menu>
    <button
        type="button"
        class="header-user-menu__toggle"
        id="header-user-toggle-{{ $suffix }}"
        aria-expanded="false"
        aria-haspopup="true"
        aria-controls="header-user-dropdown-{{ $suffix }}"
    >
        {{ $displayName }}
    </button>
    <div
        class="header-user-menu__dropdown"
        id="header-user-dropdown-{{ $suffix }}"
        role="menu"
        hidden
    >
        <a href="{{ route('admin.productos.index') }}" class="header-user-menu__item" role="menuitem">
            Panel de admin
        </a>
        <form method="POST" action="{{ route('logout') }}" class="header-user-menu__form" role="none">
            @csrf
            <button type="submit" class="header-user-menu__item header-user-menu__item--button" role="menuitem">
                Cerrar sesión
            </button>
        </form>
    </div>
</div>
