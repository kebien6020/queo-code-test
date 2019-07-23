@extends('adminlte::page')

@section('title', 'Empresa: ' . $empresa->name)

@section('content')

@include('partials.alerts')

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">{{$empresa->name}}</h3>
    </div>
    <div class="panel-body">
        @if ($empresa->logo !== null)
            <img src="{{$empresa->logo}}" class="card-img-top" alt="logo" style="float: right;">
        @endif
        @if ($empresa->email !== null)
            <p>Correo electrónico: {{$empresa->email}}</p>
        @endif
        @if ($empresa->website !== null)
            <p>Sitio web: <a href="{{$empresa->website}}">{{$empresa->website}}</a></p>
        @endif

        <h2>Lista de empleados: </h2>
        <ul>
            @forelse ($empresa->empleados as $empleado)
                <li>
                    <a href="{{route('empleados.show', $empleado->id)}}">
                        {{$empleado->name()}}
                    </a>
                </li>
            @empty
                <li>No contiene empleados por el momento 😥.</li>
            @endforelse
        </ul>
    </div>
</div>

@endsection
