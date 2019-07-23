@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <a href="{{route('empresas.index')}}" style="color: inherit">
        <div class="col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-green"><i class="fa fa-building-o"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Empresas</span>
                <span class="info-box-number">{{$empresas_count}}</span>
              </div>
            </div>
        </div>
    </a>
    <a href="{{route('empleados.index')}}" style="color: inherit">
        <div class="col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-aqua"><i class="fa fa-user-o"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Empleados</span>
                <span class="info-box-number">{{$empleados_count}}</span>
              </div>
            </div>
        </div>
    </a>
</div>
@endsection
