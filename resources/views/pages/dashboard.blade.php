@extends('layouts.app')
@section('title','Inicio')
@section('content')
<div class="container">
    <h1>Bienvenido al sistema <b>{{ auth()->user()->name }}</b></h1>
</div>
@endsection