<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        @if (auth()->check())
            <a class="navbar-brand mr-0 mr-md-2" href="{{ url('/dashboard') }}">
            @else
                <a class="navbar-brand mr-0 mr-md-2" href="{{ url('/') }}">
        @endif
        <img src="{{ url('/images/logo.jpg') }}" width="30" height="30" alt="Logo">
        Bienvenido
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @if (auth()->check())
                <ul class="navbar-nav bd-navbar-nav flex-row">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/Personal') }}">Administrar Personal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/dashboard') }}">Gestión de Almacén</a>
                    </li>
                    <li class="nav-item dropdown"> <!-- Usa Popper, una libreria de terceros -->
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Gestión de Patrimonio
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ url('/Ingresos') }}">Ingreso de Patrimonio</a>
                            <a class="dropdown-item" href="{{ url('/Bajas') }}">Baja de Patrimonio</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('/Patrimonio') }}">Reporte de Patrimonio</a>
                        </div>
                    </li>
                </ul>
            @endif
            <ul class="navbar-nav ms-auto bd-navbar-nav flex-row">
                @if (auth()->check())
                    <li class="nav-item dropdown"> <!-- Usa Popper, una libreria de terceros -->
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Bienvenido(a) <b>{{ auth()->user()->name }}</b>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('register.index') }}">Nuevo Usuario</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('login.destroy') }}">Cerrar Sesión</a>
                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login.index') }}">Iniciar Sesión</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
