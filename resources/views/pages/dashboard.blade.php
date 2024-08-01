@extends('layouts.app')
@section('title', 'Inicio')
@section('content')
    <div class="container">
        @php
            $personal = session('personal');
        @endphp
        <h1>Bienvenido(a) al sistema <b>{{ $personal->Nombres }} {{ $personal->Apellidos }}</b></h1>
        <b>{{ auth()->user()->name }}</b>
        <script>
            // Convertir el objeto personal a JSON y almacenarlo en una variable de JavaScript
            var personal = {!! json_encode($personal) !!};
            localStorage.setItem('personal', JSON.stringify(personal));
        </script>
    </div>
@endsection
