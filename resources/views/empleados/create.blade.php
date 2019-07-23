@extends('adminlte::page')

@section('title', ($edit ? 'Editar' : 'Crear') .' Empleado')

@section('content')

@include('partials.alerts')

<form action="{{$edit ? route('empleados.update', $empleado->id) : route('empleados.store')}}" method="post">
    @csrf
    @if ($edit)
        @method('put')
    @endif
    <div class="form-group">
        <label for="first_name">Nombre</label>
        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Nombre"
            @if($edit) value="{{$empleado->first_name}}" @endif
        >
    </div>
    <div class="form-group">
        <label for="last_name">Apellido</label>
        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Apellido"
            @if($edit) value="{{$empleado->last_name}}" @endif
        >
    </div>
    <div class="form-group">
        <label for="email">Correo electrónico</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Correo"
            @if($edit) value="{{$empleado->email}}" @endif
        >
    </div>
    <div class="form-group">
        <label for="phone">Teléfono</label>
        <input type="phone" class="form-control" id="phone" name="phone" placeholder="Teléfono"
            @if($edit) value="{{$empleado->phone}}" @endif
        >
    </div>
    <div class="form-group">
        <label for="company_id">Empresa</label>
        <select class="form-control" name="company_id">
            @foreach ($empresas as $empresa)
                <option value="{{$empresa->id}}"
                    @if ($edit)
                        @if ($empresa->id === $empleado->company_id)
                            selected
                        @endif
                    @endif
                >
                    {{$empresa->name}}
                </option>
            @endforeach
        </select>
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
