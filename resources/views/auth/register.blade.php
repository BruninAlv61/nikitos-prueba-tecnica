<x-guest-layout>
    <div class="auth-page">
        <div class="auth-card">
            <h1 class="auth-card__title">Crear cuenta</h1>
            <p class="auth-card__lead">Completá tus datos para registrarte.</p>

            <form method="POST" action="{{ route('register') }}" class="auth-form" novalidate>
                @csrf

                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        autofocus
                        autocomplete="given-name"
                    >
                    @error('name')
                        <span class="contacto-field-error" role="alert">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group auth-field-gap">
                    <label for="lastname">Apellido</label>
                    <input
                        id="lastname"
                        type="text"
                        name="lastname"
                        value="{{ old('lastname') }}"
                        required
                        autocomplete="family-name"
                    >
                    @error('lastname')
                        <span class="contacto-field-error" role="alert">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group auth-field-gap">
                    <label for="email">Correo electrónico</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
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
                        autocomplete="new-password"
                    >
                    @error('password')
                        <span class="contacto-field-error" role="alert">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group auth-field-gap">
                    <label for="password_confirmation">Confirmar contraseña</label>
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                    >
                    @error('password_confirmation')
                        <span class="contacto-field-error" role="alert">{{ $message }}</span>
                    @enderror
                </div>

                <div class="auth-form-actions">
                    <a class="auth-link" href="{{ route('login') }}">
                        ¿Ya tenés cuenta? Iniciar sesión
                    </a>

                    <button type="submit" class="auth-btn-submit">
                        Registrarse
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
