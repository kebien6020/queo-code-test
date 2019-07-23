@extends('adminlte::page')

@section('title', 'Empresas')

@section('content')

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
                <td><a class="btn btn-primary" href="#">Lista Empleados</a></td>
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
