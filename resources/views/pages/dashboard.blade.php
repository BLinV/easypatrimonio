@extends('layouts.app')
@section('title', 'Inicio')
@section('content')
    <div class="container-fluid ">
        @php
            $personal = session('personal');
        @endphp

        <main class="mt-2 container">
            <div class="shadow p-3 mb-3 rounded-5 text-center">
                <h1>Bienvenido(a) al sistema <b>{{ $personal->Nombres }} {{ $personal->Apellidos }}</b></h1>
            </div>

        </main>





        <script>
            // Convertir el objeto personal a JSON y almacenarlo en una variable de JavaScript
            var personal = {!! json_encode($personal) !!};
            localStorage.setItem('personal', JSON.stringify(personal));
        </script>
    </div>
@endsection
