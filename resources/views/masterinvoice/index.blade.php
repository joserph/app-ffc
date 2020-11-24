@extends('layouts.principal')

@section('content')
@can('haveaccess', 'logistics')

<section class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            
         </div>
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
               <li class="breadcrumb-item active">Empresas de Logítica</li>
            </ol>
         </div>
      </div>
   </div><!-- /.container-fluid -->
</section>

  <!-- Main content -->
<section class="content">
   <div class="container-fluid">
      @can('haveaccess', 'masterinvoice.create')
         <h2>Crear Factura Master</h2>
         @include('custom.message') 
            
         
            
         @if(!$invoiceheaders)
            <button class="btn btn-outline-primary" id="createMasterInvoice" data-toggle="modal" data-target="#exampleModal" data-toggle="tooltip" data-placement="top" title="Crear Master Invoice">
               <i class="fas fa-plus-circle"></i> Crear
            </button>
         @endif

  
         <!-- Modal -->
         <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Crear Factura Master</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  {{ Form::open(['route' => 'masterinvoices.store', 'class' => 'form-horizontal']) }}
                     <div class="modal-body">
                        
                        @include('masterinvoice.formHeader')
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-outline-primary" id="createMasterInvoice" data-toggle="tooltip" data-placement="top" title="Crear Empresa">
                           <i class="fas fa-plus-circle"></i> Crear
                     </button>
                     </div>
                  {{ Form::close() }}
               </div>
            </div>
         </div>


        @endcan
   </div>
</section>
@endcan
@endsection
