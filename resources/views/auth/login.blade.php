@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="card-body">
        <form action="{{ route('login.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <div class="row g-2 justify-content-center">
                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                    <div class="text-center">
                        <legend>Ingreso de Usuario</legend>
                    </div>
                    <div class="form-group mb-2">
                        <input type="email" id="email" name="email" class="form-control" value=""
                            placeholder="Email">
                    </div>
                    <div class="form-group mb-2">
                        <input type="password" id="password" name="password" class="form-control" value=""
                            placeholder="Contraseña">
                    </div>
                    @error('email')
                        <p>* {{ $message }}</p>
                    @enderror
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
