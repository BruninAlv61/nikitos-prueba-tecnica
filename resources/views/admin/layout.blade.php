<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Nikitos Admin</title>
    <style>
        :root {
            --admin-bg: #f5f5f5;
            --admin-surface: #fff;
            --admin-sidebar: #1a1a1a;
            --admin-accent: #F4A261;
            --admin-danger: #e63946;
            --admin-muted: #666;
            --admin-space: clamp(0.75rem, 3vw, 1rem);
            --admin-space-lg: clamp(1rem, 4vw, 2rem);
            --admin-sidebar-w: 220px;
            --admin-sidebar-drawer: min(88vw, 280px);
            --admin-topbar-h: 3.25rem;
            --admin-break: 900px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        .visually-hidden {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }

        .admin-body {
            font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
            background: var(--admin-bg);
            min-height: 100dvh;
            margin: 0;
        }

        .admin-shell {
            display: flex;
            flex-direction: column;
            min-height: 100dvh;
        }

        .admin-shell.admin-nav-open {
            overflow: hidden;
        }

        /* Barra superior: solo móvil / tablet estrecho */
        .admin-topbar {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            min-height: var(--admin-topbar-h);
            padding: 0.5rem var(--admin-space);
            padding-left: max(var(--admin-space), env(safe-area-inset-left));
            padding-right: max(var(--admin-space), env(safe-area-inset-right));
            background: var(--admin-sidebar);
            color: #fff;
            position: sticky;
            top: 0;
            z-index: 120;
            flex-shrink: 0;
        }

        .admin-menu-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 2.75rem;
            min-height: 2.75rem;
            padding: 0;
            border: none;
            border-radius: 0.5rem;
            background: #333;
            color: #fff;
            cursor: pointer;
            flex-shrink: 0;
        }

        .admin-menu-btn:hover,
        .admin-menu-btn:focus-visible {
            background: #444;
            outline: 2px solid var(--admin-accent);
            outline-offset: 2px;
        }

        .admin-topbar-title {
            font-weight: 600;
            font-size: 1rem;
            color: var(--admin-accent);
            letter-spacing: 0.02em;
        }

        .admin-frame {
            display: flex;
            flex: 1;
            min-height: 0;
            min-width: 0;
            position: relative;
        }

        .admin-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
            z-index: 100;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.2s ease, visibility 0.2s ease;
        }

        .admin-shell.admin-nav-open .admin-backdrop {
            opacity: 1;
            visibility: visible;
        }

        .admin-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: var(--admin-sidebar-drawer);
            max-width: 100%;
            background: var(--admin-sidebar);
            color: #fff;
            z-index: 110;
            transform: translateX(-100%);
            transition: transform 0.22s ease;
            display: flex;
            flex-direction: column;
            padding: max(1rem, env(safe-area-inset-top)) max(1rem, env(safe-area-inset-left)) 1rem;
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
        }

        .admin-shell.admin-nav-open .admin-sidebar {
            transform: translateX(0);
        }

        .admin-sidebar-brand {
            font-size: 1.125rem;
            margin-bottom: 1rem;
            color: var(--admin-accent);
        }

        .admin-sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            flex: 1;
        }

        .admin-sidebar a {
            color: #ccc;
            text-decoration: none;
            padding: 0.625rem 0.75rem;
            border-radius: 0.375rem;
            display: block;
            font-size: 0.9375rem;
        }

        .admin-sidebar a:hover {
            background: #333;
            color: #fff;
        }

        .admin-sidebar a.active {
            background: var(--admin-accent);
            color: #fff;
        }

        .admin-sidebar-logout {
            margin-top: auto;
            padding-top: 1rem;
        }

        .admin-sidebar-logout .btn {
            width: 100%;
            text-align: left;
        }

        .admin-main {
            flex: 1;
            width: 100%;
            min-width: 0;
            padding: var(--admin-space-lg);
            padding-bottom: max(var(--admin-space-lg), env(safe-area-inset-bottom));
        }

        .admin-main h1 {
            font-size: clamp(1.25rem, 4vw, 1.5rem);
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .page-header {
            display: flex;
            flex-direction: column;
            align-items: stretch;
            gap: 0.75rem;
            margin-bottom: 1.25rem;
        }

        .page-header h1 {
            margin-bottom: 0;
        }

        .page-header .btn {
            align-self: flex-start;
        }

        .table-wrap {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            margin-bottom: 1rem;
            border-radius: 0.5rem;
            background: var(--admin-surface);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
        }

        .table-wrap table {
            min-width: 100%;
        }

        /* Listados con muchas columnas: scroll horizontal en pantallas chicas */
        .table-wrap--wide table {
            min-width: 36rem;
        }

        .cell-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            align-items: center;
            vertical-align: middle;
        }

        .cell-actions form {
            display: inline-flex;
        }

        .form-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.625rem;
            align-items: center;
            margin-top: 0.5rem;
        }

        .admin-form-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .admin-detail-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 0.75rem 1rem;
            margin-bottom: 1.25rem;
        }

        .admin-field-row {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            align-items: center;
        }

        .admin-field-row > input,
        .admin-field-row > textarea {
            flex: 1 1 12rem;
            min-width: 0;
            padding: 0.5rem 0.75rem;
            border: 1px solid #ddd;
            border-radius: 0.375rem;
            font-size: 1rem;
            font-family: inherit;
        }

        .admin-field-row > textarea {
            resize: vertical;
            line-height: 1.5;
        }

        .admin-field-row--start {
            align-items: flex-start;
        }

        .admin-field-row--start .btn {
            margin-top: 0.125rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 2.5rem;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            cursor: pointer;
            text-decoration: none;
            border: none;
            line-height: 1.2;
        }

        .btn-primary { background: var(--admin-accent); color: #fff; }
        .btn-danger { background: var(--admin-danger); color: #fff; }
        .btn-secondary { background: #ccc; color: #333; }

        table {
            width: 100%;
            border-collapse: collapse;
            background: var(--admin-surface);
            border-radius: 0.5rem;
            overflow: hidden;
        }

        th, td {
            padding: 0.75rem 1rem;
            text-align: left;
            border-bottom: 1px solid #eee;
            font-size: 0.875rem;
        }

        th {
            background: #f9f9f9;
            font-weight: 600;
            white-space: nowrap;
        }

        .alert {
            padding: 0.75rem 1rem;
            border-radius: 0.375rem;
            margin-bottom: 1rem;
            font-size: 0.875rem;
        }

        .alert-success { background: #d4edda; color: #155724; }

        .form-group { margin-bottom: 1rem; }

        .form-group label {
            display: block;
            font-size: 0.8125rem;
            font-weight: 600;
            margin-bottom: 0.375rem;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            min-height: 2.75rem;
            padding: 0.5rem 0.75rem;
            border: 1px solid #ddd;
            border-radius: 0.375rem;
            font-size: 1rem;
        }

        .form-group input[type="checkbox"] {
            width: auto;
            min-height: auto;
        }

        .form-group input[type="file"] {
            min-height: auto;
            padding: 0.5rem 0;
        }

        .form-error {
            color: #c81e1e;
            font-size: 0.8125rem;
            margin-top: 0.375rem;
            display: block;
        }

        .form-card {
            background: var(--admin-surface);
            padding: clamp(1rem, 4vw, 1.5rem);
            border-radius: 0.5rem;
            max-width: 600px;
            width: 100%;
        }

        .form-card--wide { max-width: 960px; }

        .form-group textarea {
            width: 100%;
            padding: 0.625rem 0.75rem;
            border: 1px solid #ddd;
            border-radius: 0.375rem;
            font-size: 1rem;
            font-family: inherit;
            line-height: 1.5;
            resize: vertical;
            min-height: 6rem;
        }

        img.thumb {
            width: 48px;
            height: 48px;
            object-fit: cover;
            border-radius: 0.25rem;
        }

        .admin-breadcrumb {
            font-size: 0.875rem;
            color: var(--admin-muted);
            margin-bottom: 0.75rem;
        }

        .admin-breadcrumb a {
            color: var(--admin-accent);
            text-decoration: none;
        }

        .admin-breadcrumb a:focus-visible {
            outline: 2px solid var(--admin-accent);
            outline-offset: 2px;
        }

        .admin-lead {
            color: var(--admin-muted);
            margin-bottom: 1.25rem;
            font-size: 0.875rem;
            line-height: 1.5;
        }

        @media (min-width: 600px) {
            .page-header {
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: space-between;
                align-items: center;
            }

            .page-header .btn {
                align-self: center;
            }
        }

        @media (min-width: 500px) {
            .admin-form-grid { grid-template-columns: 1fr 1fr; }
        }

        @media (min-width: 560px) {
            .admin-detail-grid { grid-template-columns: 1fr 1fr; }
        }

        @media (min-width: 900px) {
            .admin-topbar {
                display: none;
            }

            .admin-backdrop {
                display: none !important;
            }

            .admin-frame {
                flex-direction: row;
            }

            .admin-sidebar {
                position: relative;
                transform: none !important;
                width: var(--admin-sidebar-w);
                flex-shrink: 0;
                padding: 1.5rem 1rem;
                transition: none;
            }

            .admin-shell.admin-nav-open {
                overflow: visible;
            }

            .admin-shell.admin-nav-open .admin-sidebar {
                transform: none;
            }

            .admin-main {
                padding: 2rem;
            }
        }
    </style>
</head>
<body class="admin-body">
    <div class="admin-shell" id="admin-shell" data-admin-shell>
        <header class="admin-topbar">
            <button
                type="button"
                class="admin-menu-btn"
                id="admin-menu-btn"
                aria-controls="admin-sidebar"
                aria-expanded="false"
                data-admin-menu-btn
            >
                <span class="visually-hidden">Menú de administración</span>
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <span class="admin-topbar-title">Nikitos Admin</span>
        </header>

        <div class="admin-frame">
            <div class="admin-backdrop" data-admin-backdrop hidden aria-hidden="true"></div>

            <aside id="admin-sidebar" class="admin-sidebar" data-admin-sidebar>
                <h2 class="admin-sidebar-brand">Nikitos Admin</h2>
                <nav class="admin-sidebar-nav" aria-label="Administración">
                    <a href="{{ route('admin.productos.index') }}" @class(['active' => request()->routeIs('admin.productos.*')])>Productos</a>
                    <a href="{{ route('admin.categorias.index') }}" @class(['active' => request()->routeIs('admin.categorias.*')])>Categorías</a>
                    <a href="{{ route('admin.recetas.index') }}" @class(['active' => request()->routeIs('admin.recetas.*')])>Recetas</a>
                    <a href="{{ route('admin.contactos.index') }}" @class(['active' => request()->routeIs('admin.contactos.*')])>Contactos</a>
                    <a href="{{ route('admin.contenido.index') }}" @class(['active' => request()->routeIs('admin.contenido.*', 'admin.nosotros.*', 'admin.inicio-contenido.*')])>Contenido</a>
                    <a href="{{ route('home') }}">Ver sitio</a>
                </nav>
                <div class="admin-sidebar-logout">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn" style="background:#333; color:#ccc;">
                            Cerrar sesión
                        </button>
                    </form>
                </div>
            </aside>

            <main class="admin-main">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @yield('contenido')
            </main>
        </div>
    </div>

    <script>
        (function () {
            var shell = document.querySelector('[data-admin-shell]');
            var btn = document.querySelector('[data-admin-menu-btn]');
            var sidebar = document.querySelector('[data-admin-sidebar]');
            var backdrop = document.querySelector('[data-admin-backdrop]');
            if (!shell || !btn || !sidebar || !backdrop) return;

            var mq = window.matchMedia('(min-width: 900px)');

            function setOpen(open) {
                shell.classList.toggle('admin-nav-open', open);
                btn.setAttribute('aria-expanded', open ? 'true' : 'false');
                backdrop.hidden = !open;
                document.body.style.overflow = open && !mq.matches ? 'hidden' : '';
            }

            function closeNav() {
                setOpen(false);
            }

            btn.addEventListener('click', function () {
                setOpen(!shell.classList.contains('admin-nav-open'));
            });

            backdrop.addEventListener('click', closeNav);

            mq.addEventListener('change', function (e) {
                if (e.matches) closeNav();
            });

            sidebar.querySelectorAll('a[href]').forEach(function (link) {
                link.addEventListener('click', function () {
                    if (!mq.matches) closeNav();
                });
            });

            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') closeNav();
            });
        })();
    </script>
</body>
</html>
