@extends('adminlte::page')

@section('title', 'Empresas')

@section('content')

@include('partials.alerts')

<div class="text-center">
    <a class="btn btn-primary" href="{{route('empresas.create')}}">Crear Empresa</a>
</div>

<table id="empresas-table" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Logo</th>
            <th>Nombre</th>
            <th>Correo electrónico</th>
            <th>Sitio web</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($empresas as $empresa)
            <tr>
                <td>
                    @if ($empresa->logo !== null)
                        <img src="{{$empresa->logo}}" class="card-img-top" alt="logo">
                    @endif
                </td>
                <td>{{$empresa->name}}</td>
                <td>{{$empresa->email ? $empresa->email : ''}}</td>
                <td>
                    @if ($empresa->website !== null)
                        <a href="{{$empresa->website}}">{{$empresa->website}}</a>
                    @endif
                </td>
                <td>
                    <a class="btn btn-primary" href="{{route('empresas.show', $empresa->id)}}">Lista Empleados</a>
                    <a class="btn btn-primary" href="{{route('empresas.edit', $empresa->id)}}">Editar</a>
                    <form action="{{route('empresas.destroy', $empresa->id)}}" method="post">
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
            <th>Logo</th>
            <th>Nombre</th>
            <th>Correo electrónico</th>
            <th>Sitio web</th>
            <th></th>
        </tr>
    </tfoot>
</table>

<div class="text-center">
    {{$empresas->links()}}
</div>

@endsection

@section('js')
<script>

$(document).ready(function() {
    $('#empresas-table').DataTable({
        paging: false,
        info: false,
        searching: false,
    });
} );

</script>
@endsection
