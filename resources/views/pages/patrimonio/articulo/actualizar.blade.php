@extends('layouts.app')
@section('title','Sistema de Control Patrimonial - Actualizar registros Patrimonio')
@section('content')
<script src="{{ asset('js/origenServicioCategoria.js') }}"></script>

<div class="container">
    <h1>Actualizar</h1>
    <main>
        <form action="javascrip:void(0)" method="POST" enctype="multipart/form-data" autocomplete="off">
            @include('pages.shared.articulo',['vista'=>['articulo'=>true, 'operativo'=>false, 'ubicacion'=>false, 'comentario'=>true, 'boton'=>'Actualizar']])
        </form>
    </main>
</div>
@endsection