<style>
    #navegacion {
        width: 30%;
        min-width: max-content;
        max-width: 100%;
        height: min-content;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-light ">
    <div class="container-fluid">

        @if (auth()->check())
            <a class="navbar-brand" href="{{ url('/dashboard') }}">
            @else
                <a class="navbar-brand" href="{{ url('/') }}">
        @endif
        <img src="{{ url('/images/logo.jpg') }}" width="30" height="30" alt="Logo">
        Sistema Almacén
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navegacion"
            aria-controls="navegacion">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end rounded-end-5 rounded-start-5 mt-md-2 mx-md-2" tabindex="-1"
            id="navegacion" aria-labelledby="offcanvasNavbarLabel">
            <!--div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div-->
            <div class="offcanvas-body text-center">

                <ul class="navbar-nav justify-content-end flex-grow-1">
                    @if (auth()->check())
                        <div class="d-lg-none">
                            <h5>Hospital Laredo</h5>
                            <img src="{{ url('/images/logo.jpg') }}" width="150" height="150"
                                class="img-thumbnail rounded-circle">
                            <div class = "fs-6 fw-bold text-center">
                                {{ auth()->user()->name }}
                            </div>
                        </div>

                        <hr class="border border-dark" />
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/Personal') }}">Administrar Personal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/dashboard') }}">Gestión de Almacén</a>
                        </li>
                        <li class="nav-item dropdown"> <!-- Usa Popper, una libreria de terceros -->
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Gestión de Patrimonio
                            </a>
                            <div class="dropdown-menu rounded-5 text-center px-2" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ url('/Ingresos') }}">Ingreso de Patrimonio</a>
                                <a class="dropdown-item" href="{{ url('/Bajas') }}">Baja de Patrimonio</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ url('/Patrimonio') }}">Reporte de Patrimonio</a>
                            </div>
                        </li>
                        <hr class="border border-dark" />
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register.index') }}">Nuevo Usuario</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login.destroy') }}">Cerrar Sesión</a>
                        </li>
                    @else
                        <div class="d-lg-none">
                            <h5>Hospital Laredo</h5>
                            <img src="{{ url('/images/logo.jpg') }}" width="150" height="150"
                                class="img-thumbnail rounded-circle">
                        </div>
                        <hr class="border border-dark" />

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login.index') }}">Iniciar Sesión</a>
                        </li>
                    @endif
                </ul>

            </div>
        </div>
    </div>
</nav>
