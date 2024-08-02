@extends('layouts.auth')
@section('title', 'Login')
@section('content')
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            width: 100%;
            max-width: 100%;
        }
        body {
            width: 100%;
            max-width: 100%;
            position: relative;
            background-image: url("images/foto.jpg");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
    <div class="row g-2 justify-content-center" style="margin-top: 10px;">
        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-header bg-white text-center">
                    <legend>Ingreso de Usuario</legend>
                </div>
                <div class="card-body">
                    <form action="{{ route('login.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="form-group mb-2">
                            <input type="email" id="email" name="email" class="form-control shadow-none" value=""
                                placeholder="Email">
                        </div>
                        <div class="form-group mb-2">
                            <input type="password" id="password" name="password" class="form-control shadow-none" value=""
                                placeholder="Contraseña">
                        </div>
                        @error('email')
                            <p>* {{ $message }}</p>
                        @enderror
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
