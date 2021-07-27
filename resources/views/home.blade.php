@extends('layouts.principal')

@section('content')
<div class="container">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Panel Principal</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item active">Panel Principal v1</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
    <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{ $farms }}</h3>

              <p>Fincas Agregadas</p>
            </div>
            <div class="icon">
                <i class="nav-icon fas fa-spa"></i>
            </div>
            <a href="{{ url('farms') }}" class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{ $clients }}</h3>

              <p>Clientes</p>
            </div>
            <div class="icon">
                <i class="nav-icon fas fa-user-tie"></i>
            </div>
            <a href="{{ url('clients') }}" class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{ $varieties }}</h3>

              <p>Variedades</p>
            </div>
            <div class="icon">
                <i class="nav-icon fas fa-fan"></i>
            </div>
            <a href="{{ url('varieties') }}" class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{ $loads }}</h3>

              <p>Contenedores</p>
            </div>
            <div class="icon">
                <i class="nav-icon fas fa-truck-loading"></i>
            </div>
            <a href="{{ route('load.index') }}" class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
   </div>
@endsection
