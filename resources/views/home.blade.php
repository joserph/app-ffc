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
            @can('haveaccess', 'farms')
               <a href="{{ url('farms') }}" class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></a>
            @endcan
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
            @can('haveaccess', 'clients')
               <a href="{{ url('clients') }}" class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></a>
            @endcan
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
            @can('haveaccess', 'varieties')
               <a href="{{ url('varieties') }}" class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></a>
            @endcan
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
            @can('haveaccess', 'load.index')
               <a href="{{ route('load.index') }}" class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></a>
            @endcan
         </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
         <!-- small box -->
         <div class="small-box bg-primary">
            <div class="inner">
               <h3>{{ $flights }}</h3>
               <p>Vuelos</p>
            </div>
            <div class="icon">
               <i class="nav-icon fas fa-plane"></i>
            </div>
            @can('haveaccess', 'flight.index')
               <a href="{{ route('flight.index') }}" class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></a>
            @endcan
         </div>
      </div>
      <div class="col-lg-3 col-6">
         <div class="small-box bg-info">
            <div class="inner">
               <h3>{{ $company }}</h3>
               <p>{{ Str::title(Str::limit($companyName[0]->name, '16')) }}</p>
            </div>
            <div class="icon">
               <i class="nav-icon fas fa-building"></i>
            </div>
            @can('haveaccess', 'companies')
               <a href="{{ url('companies') }}" class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></a>
            @endcan
         </div>
      </div>
      <div class="col-lg-3 col-6">
         <div class="small-box bg-success">
            <div class="inner">
               <h3>{{ $logisticCompany }}</h3>
               <p>{{ Str::title(Str::limit($logisticCompanyName[0]->name, '18')) }}</p>
            </div>
            <div class="icon">
               <i class="nav-icon fas fa-warehouse"></i>
            </div>
            @can('haveaccess', 'logistics')
               <a href="{{ url('logistics') }}" class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></a>
            @endcan
         </div>
      </div>
      <div class="col-lg-3 col-6">
         <div class="small-box bg-warning">
            <div class="inner">
               <h3>{{ $colors }}</h3>
               <p>Colores</p>
            </div>
            <div class="icon">
               <i class="nav-icon fas fa-palette"></i>
            </div>
            @can('haveaccess', 'color.index')
               <a href="{{ route('color.index') }}" class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></a>
            @endcan
         </div>
      </div>




   </div><!-- /end row -->
</div>
@endsection
