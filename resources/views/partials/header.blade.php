{{-- header.blade.php --}}

<header class="header">
    <img class="logo" src="{{ asset('images/logo.png') }}" alt="logo">

    <button class="button-login--desktop">Ingresar <svg data-v-e4c01033="" width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path data-v-e4c01033="" d="M6.33333 8.33335V5.83335C6.33333 4.72828 6.77232 3.66848 7.55372 2.88708C8.33512 2.10567 9.39493 1.66669 10.5 1.66669C11.6051 1.66669 12.6649 2.10567 13.4463 2.88708C14.2277 3.66848 14.6667 4.72828 14.6667 5.83335V8.33335M11.3333 13.3334C11.3333 13.7936 10.9602 14.1667 10.5 14.1667C10.0398 14.1667 9.66667 13.7936 9.66667 13.3334C9.66667 12.8731 10.0398 12.5 10.5 12.5C10.9602 12.5 11.3333 12.8731 11.3333 13.3334ZM4.66667 8.33335H16.3333C17.2538 8.33335 18 9.07955 18 10V16.6667C18 17.5872 17.2538 18.3334 16.3333 18.3334H4.66667C3.74619 18.3334 3 17.5872 3 16.6667V10C3 9.07955 3.74619 8.33335 4.66667 8.33335Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg></button>

    <button class="menu-button"><svg data-v-e4c01033="" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path data-v-e4c01033="" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg></button>
    
    <x-nav />
    <div class="overlay"></div>
</header>