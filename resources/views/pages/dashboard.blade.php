@extends('layouts.app')
@section('title', 'Inicio')
@section('content')
    <div class="container">
        <h1>Bienvenido al sistema <b>{{ auth()->user()->name }}</b></h1>
        <script>
            var IdPersonal = {{ session('IdPersonal') }};
            localStorage.setItem('IdPersonal', IdPersonal); // Obtener IdPersonal del backend y almacenarlo en localStorage
        </script>
    </div>
@endsection
