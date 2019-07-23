@extends('adminlte::page')

@section('title', ($edit ? 'Editar' : 'Crear') .' Empresa')

@section('content')

@include('partials.alerts')

<form action="{{$edit ? route('empresas.update', $empresa->id) : route('empresas.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    @if ($edit)
        @method('put')
    @endif
    <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Nombre"
            @if($edit) value="{{$empresa->name}}" @endif
        >
    </div>
    <div class="form-group">
        <label for="email">Correo electrónico</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Correo"
            @if($edit) value="{{$empresa->email}}" @endif
        >
    </div>
    <div class="form-group">
        <label for="logo">Logo</label>
        <input type="file" id="logo" name="logo">
        <p class="help-block">Minimo 100px por 100px.</p>
    </div>
    <div class="form-group">
        <label for="website">Sitio web</label>
        <input type="text" class="form-control" id="website" name="website" placeholder="Sitio web"
            @if($edit) value="{{$empresa->website}}" @endif
        >
    </div>

    <button type="submit" class="btn btn-default">
        @if ($edit)
            Guardar
        @else
            Crear
        @endif
    </button>
</form>

@endsection
