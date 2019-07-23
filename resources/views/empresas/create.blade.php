@extends('adminlte::page')

@section('title', 'Crear Empresa')

@section('content')

@include('partials.alerts')

<form action="{{route('empresas.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Nombre">
    </div>
    <div class="form-group">
        <label for="email">Correo electrónico</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Correo">
    </div>
    <div class="form-group">
        <label for="logo">Logo</label>
        <input type="file" id="logo" name="logo">
        <p class="help-block">Minimo 100px por 100px.</p>
    </div>
    <div class="form-group">
        <label for="website">Sitio web</label>
        <input type="text" class="form-control" id="website" name="website" placeholder="Sitio web">
    </div>

    <button type="submit" class="btn btn-default">Crear</button>
</form>

@endsection
