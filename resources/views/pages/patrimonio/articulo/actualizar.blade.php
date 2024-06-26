@extends('layouts.app')
@section('title','Sistema de Control Patrimonial - Actualizar registros Patrimonio')
@section('content')
<div class="container">
    <h1>Actualizar</h1>
    <main>
        <form action="javascrip:void(0)" method="POST" enctype="multipart/form-data" autocomplete="off">
        @include('pages.shared.articulo',['vista'=>['tipo'=>true, 'boton'=>'Actualizar']])
        </form>
        <script src="{{ asset('js/origenServicioCategoria.js') }}"></script>
        <script src="{{ asset('js/autocompletar.js') }}"></script>
    </main>
</div>
@endsection