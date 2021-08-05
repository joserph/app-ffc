@extends('layouts.principal')

@section('title') {{ $flight->awb }} | Sistema de Carguera v1.1 @stop

@section('content')
<section class="content-header">
    <div class="container-fluid">
       <div class="row mb-2">
          <div class="col-sm-6">
             <h1>AWB - {{ $flight->awb }}</h1>
          </div>
          <div class="col-sm-6">
             <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('flight.index') }}">Vuelos</a></li>
                <li class="breadcrumb-item active">{{ $flight->awb }}</li>
             </ol>
          </div>
       </div>
    </div><!-- /.container-fluid -->
 </section>



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <!-- Factura Master -->
            <div class="row">
              <!-- Coordinaciones -->
              <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-primary">
                  <div class="inner">
                    <h3>222</h3>
    
                    <p>Fincas Coordinadas</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-grip-vertical"></i>
                  </div>
                   <a href="{{ route('flights', $flight->id) }}" class="small-box-footer">
                    Ver coordinaciones <i class="fas fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>

              <!-- Proyeccion de peso -->
              <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-secondary">
                  <div class="inner">
                    <h3>111</h3>
    
                    <p>Proyeccion de peso</p>
                  </div>
                  <div class="icon">
                     <i class="fas fa-balance-scale-right"></i>
                  </div>
                   <a href="#" class="small-box-footer">
                    Ver Proyeccion de peso <i class="fas fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>
           </div>

        
        </div>
    </div>
</div>
@endsection
