@extends('layouts.principal')

@section('content')
<section class="content-header">
    <div class="container-fluid">
       <div class="row mb-2">
          <div class="col-sm-6">
             <h1>Crear Carga
                
             </h1>
          </div>
          <div class="col-sm-6">
             <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('load.index') }}">Cargas</a></li>
                <li class="breadcrumb-item active">Crear Carga</li>
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
                <div class="col-lg-3 col-6">
                  <!-- small card -->
                  <div class="small-box bg-info">
                    <div class="inner">
                      <h3>{{ $loadCount }}</h3>
      
                      <p>Items de la factura</p>
                    </div>
                    <div class="icon">
                     <i class="fas fa-file-invoice-dollar"></i>
                    </div>
                     <a href="{{ route('masterinvoices.index', $load->id) }}" class="small-box-footer">
                      Ver Master Invoice <i class="fas fa-arrow-circle-right"></i>
                    </a>
                  </div>
                </div>
            
               <!-- ISF -->
               <div class="col-lg-3 col-6">
                 <!-- small card -->
                 <div class="small-box bg-success">
                   <div class="inner">
                     <h3>{{ $farmsCount }}</h3>
     
                     <p>Fincas</p>
                   </div>
                   <div class="icon">
                     <i class="fas fa-file-alt"></i>
                   </div>
                    <a href="{{ route('isf.index', $load->id) }}" class="small-box-footer">
                     Ver ISF <i class="fas fa-arrow-circle-right"></i>
                   </a>
                 </div>
               </div>

               <!-- Plano de carga -->
               <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3>{{ $farmsCount }}</h3>
    
                    <p>Plano de Carga</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-grip-vertical"></i>
                  </div>
                   <a href="{{ route('loadingplane.index', $load->id) }}" class="small-box-footer">
                    Ver Plano <i class="fas fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>

              <!-- Coordinaciones -->
              <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-primary">
                  <div class="inner">
                    <h3>{{ $farmsCount }}</h3>
    
                    <p>Coordinaciones</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-grip-vertical"></i>
                  </div>
                   <a href="{{ route('coordination.index', $load->id) }}" class="small-box-footer">
                    Ver coordinaciones <i class="fas fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>
           </div>

        
        </div>
    </div>
</div>
@endsection
