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
               <li class="breadcrumb-item active">Factura Master</li>
            </ol>
         </div>
      </div>
   </div><!-- /.container-fluid -->
</section>

  <!-- Main content -->
<section id="invoiceitem" class="content">
   <div class="container-fluid">
      @can('haveaccess', 'masterinvoice.create')
         <h2>Crear Factura Master</h2>
         @include('custom.message') 
            
         
         @if(!$invoiceheaders)   
         <!-- Button trigger modal -->
         <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#createInvoiceHeader" >
            <i class="fas fa-plus-circle"></i> Crear
         </button>
         @endif
 
            <!-- Modal -->
            <div class="modal fade" id="createInvoiceHeader" tabindex="-1" aria-labelledby="createInvoiceHeaderLabel" aria-hidden="true">
               <div class="modal-dialog modal-xl">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="createInvoiceHeaderLabel">Crear Factura Master</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
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
            </div>

         @endcan

         @if($invoiceheaders)
         <!-- Invoice Header -->
         <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
               <div class="col-12">
                  <h4>
                     <i class="fas fa-file-invoice-dollar"></i> Factura Master
                     <small class="float-right">Fecha: {{ date('d-M-Y', strtotime($invoiceheaders->date)) }}</small>
                  </h4>
               </div>
               <!-- /.col -->
            </div>
         <!-- info row -->
         <div class="row invoice-info">
           <div class="col-sm-4 invoice-col">
               Nombre y Dirección Cultivo
             <address>
               <strong>{{ strtoupper($lc_active->name) }}</strong><br>
               <strong>Ruc:</strong> {{ $lc_active->ruc }}<br>
               {{ $lc_active->address }}<br>
               {{ $lc_active->city }}, {{ $lc_active->state }} - {{ $lc_active->country }}<br>
               <strong>Teléfono:</strong> {{ $lc_active->phone }}
             </address>
           </div>
           <!-- /.col -->
           <div class="col-sm-4 invoice-col">
               Comprador Extranjero
             <address>
               <strong>{{ strtoupper($company->name) }}</strong><br>
               {{ $company->address }}<br>
               {{ $company->city }}, {{ $company->state }} - {{ $company->country }}<br>
               <strong>Teléfono:</strong> {{ $company->phone }}
             </address>
           </div>
           <!-- /.col -->
           <div class="col-sm-4 invoice-col">
             <b>Finca: VF</b><br>
             <b>País: GYE</b><br>
             <b>Factura: {{ $invoiceheaders->invoice }}</b><br>
             <br>
             <b>BL:</b> {{ $invoiceheaders->bl }}<br>
             <b>Transportista:</b> {{ $invoiceheaders->carrier }}<br>
           </div>
           <!-- /.col -->
         </div>
         <!-- /.row -->
         <hr>
         <pre>
            @{{ $data }}
         </pre>
         <hr>
         <!-- Button trigger modal -->
         <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#agregarItem">
            <i class="fas fa-plus-circle"></i> Crear Item
         </button>
         
         <!-- Modal -->
         <div class="modal fade" id="agregarItem" tabindex="-1" aria-labelledby="agregarItemLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="agregarItemLabel">Agregar item de la factura</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <form method="POST" v-on:submit.prevent="createInvoiceItem">
                     <div class="modal-body">
                        
                        @include('masterinvoice.formItems')
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-outline-primary" id="createMasterInvoice" data-toggle="tooltip" data-placement="top" title="Crear Empresa">
                           <i class="fas fa-plus-circle"></i> Crear
                     </button>
                     </div>
                  </form>
               </div>
            </div>
            </div>
         </div>
         <hr>
         <!-- Table row -->
         <div class="row">
           <div class="col-12 table-responsive">
             <table class="table table-striped">
               <thead>
               <tr>
                 <th>Fulls</th>
                 <th>Pcs</th>
                 <th>Proveedor de flores</th>
                 <th>Description</th>
                 <th>HAWB</th>
                 <th>Acción</th>
               </tr>
               </thead>
               <tbody>
               <tr v-for="item in invoiceitems">
                <td>@{{ item.fulls }}</td>
                 <td>@{{ item.pieces }}</td>
                 <td>@{{ item.id_farm }}</td>
                 <td>@{{ item.description }}</td>
                 <td>@{{ item.hawb }}</td>
                 <td>
                   <a href="#" class="btn btn-warning btn-sm" >Editar</a>
                   <a href="#" class="btn btn-danger btn-sm" v-on:click.prevent="deleteInvoiveItem(item)">Eliminar</a>
                 </td>
               </tr>
               
               </tbody>
             </table>
           </div>
           <!-- /.col -->
         </div>
         <!-- /.row -->

         

         
       </div>
       <!-- /. End invoice header -->
       @endif

   </div>
</section>
@endcan
@endsection
