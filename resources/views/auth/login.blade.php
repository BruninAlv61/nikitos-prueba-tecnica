<x-guest-layout>
    <div class="auth-page">
        <div class="auth-card">
            @if (session('status'))
                <div class="contacto-success auth-status" role="status">{{ session('status') }}</div>
            @endif

            <h1 class="auth-card__title">Iniciar sesión</h1>
            <p class="auth-card__lead">Ingresá con tu cuenta para continuar.</p>

            <form method="POST" action="{{ route('login') }}" class="auth-form" novalidate>
                @csrf

                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"
                    >
                    @error('email')
                        <span class="contacto-field-error" role="alert">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group auth-field-gap">
                    <label for="password">Contraseña</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                    >
                    @error('password')
                        <span class="contacto-field-error" role="alert">{{ $message }}</span>
                    @enderror
                </div>

                <label class="auth-remember" for="remember_me">
                    <input id="remember_me" type="checkbox" name="remember" value="1" @checked(old('remember'))>
                    <span>Recordarme</span>
                </label>

                <div class="auth-form-actions">
                    @if (Route::has('password.request'))
                        <a class="auth-link" href="{{ route('password.request') }}">
                            ¿Olvidaste tu contraseña?
                        </a>
                    @endif

                    <button type="submit" class="auth-btn-submit">
                        Ingresar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
