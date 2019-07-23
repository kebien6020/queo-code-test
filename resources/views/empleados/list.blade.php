@extends('adminlte::page')

@section('title', 'Empleados')

@section('content')

@include('partials.alerts')

<div class="text-center">
    <a class="btn btn-primary" href="{{route('empleados.create')}}">Crear Empleado</a>
</div>

<table id="empleados-table" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Correo electrónico</th>
            <th>Teléfono</th>
            <th>Empresa</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($empleados as $empleado)
            <tr>
                <td>{{$empleado->first_name}}</td>
                <td>{{$empleado->last_name}}</td>
                <td>{{$empleado->email ? $empleado->email : ''}}</td>
                <td>{{$empleado->phone ? $empleado->phone : ''}}</td>
                <td>
                    <a href="{{route('empresas.show', $empleado->empresa->id)}}">{{$empleado->empresa->name}}</a>
                </td>
                <td>
                    <a class="btn btn-primary" href="{{route('empleados.edit', $empleado->id)}}">Editar</a>
                    <form action="{{route('empleados.destroy', $empleado->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Correo electrónico</th>
            <th>Teléfono</th>
            <th>Empresa</th>
            <th></th>
        </tr>
    </tfoot>
</table>

<div class="text-center">
    {{$empleados->links()}}
</div>

@endsection

@section('js')
<script>

$(document).ready(function() {
    $('#empleados-table').DataTable({
        paging: false,
        info: false,
        searching: false,
    });
} );

</script>
@endsection
