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
 
            <!-- Modal create header invoice -->
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
         <!-- Button trigger modal -->
         <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#agregarItem">
            <i class="fas fa-plus-circle"></i> Crear Item
         </button>

         <a href="{{ route('comercial-invoice.pdf', $load) }}" target="_blank" class="btn btn-xs btn-outline-success pull-right"><i class="far fa-file-pdf"></i></a>
         <a href="{{ route('shiptment-confirmation.pdf', $load) }}" target="_blank" class="btn btn-xs btn-outline-default pull-right"><i class="far fa-file-pdf"></i></a>
         <a href="{{ route('shiptment-confirmation-internal-use.pdf', $load) }}" target="_blank" class="btn btn-xs btn-outline-info pull-right"><i class="far fa-file-pdf"></i></a>
         <!-- Button for modal editFormHeader -->
         <button type="button" class="btn btn-outline-warning float-right" data-toggle="modal" data-target="#editInvoiceHeader" >
            <i class="fas fa-edit"></i> Editar
         </button>

         <!-- Modal edit header invoice -->
         <div class="modal fade" id="editInvoiceHeader" tabindex="-1" aria-labelledby="editInvoiceHeaderLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="editInvoiceHeaderLabel">Editar Factura Master</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  {{ Form::model($invoiceheaders, ['route' => ['masterinvoices.update', $invoiceheaders->id], 'class' => 'form-horizontal', 'method' => 'PUT']) }}
                     <div class="modal-body">
                        
                        @include('masterinvoice.editFormHeader')
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-outline-warning" id="editMasterInvoice" data-toggle="tooltip" data-placement="top" title="Crear Empresa">
                           <i class="fas fa-sync-alt"></i> Actualizar
                     </button>
                     </div>
                  {{ Form::close() }}
               </div>
            </div>
            </div>
         </div>
         
         <!-- Modal Add Master Invoice Items -->
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
                  <th class="text-center">Fulls</th>
                  <th class="text-center">HB</th>
                  <th class="text-center">QB</th>
                  <th class="text-center">EB</th>
                  <th class="text-center">Pcs</th>
                  <th class="text-center">Farms</th>
                  <th class="text-center">Client</th>
                  <th class="text-center">Desciption</th>
                  <th class="text-center">Hawb</th>
                  <th class="text-center">Stems</th>
                  <th class="text-center">Bunch</th>
                  <th class="text-center">Price</th>
                  <th class="text-center">Total USD</th>
                  <th colspan="2" class="text-center">Aciones</th>
               </tr>
               </thead>
               <tbody>
                  
               <tr v-for="item in invoiceitems">
                <td class="text-center" id="fulls">@{{ item.fulls.toFixed(3) }}</td>
                 <td class="text-center">@{{ item.hb }}</td>
                 <td class="text-center">@{{ item.qb }}</td>
                 <td class="text-center">@{{ item.eb }}</td>
                 <td class="text-center">@{{ item.pieces }}</td>
                  <td class="text-center">@{{ item.name }}</td>
                 <td class="text-center">@{{ item.client.name }}</td>
                 <td class="text-center">@{{ item.variety.name }}</td>
                 <td class="text-center">@{{ item.hawb }}</td>
                 <td class="text-center">@{{ item.stems  }}</td>
                 <td class="text-center">@{{ item.bunches }}</td>
                 <td class="text-center">@{{ item.price.toFixed(2) }}</td>
                 <td class="text-center">@{{ item.total.toFixed(2) }}</td>
                 <td class="text-center">
                   <a href="#" class="btn btn-outline-warning btn-sm" v-on:click.prevent="editInvoiceItem(item)"><i class="fas fa-pencil-alt"></i></a>
                   <a href="#" class="btn btn-outline-danger btn-sm" v-on:click.prevent="deleteInvoiveItem(item)"><i class="fas fa-trash-alt"></i></a>
                 </td>
               </tr>
               </tbody>
               <tfoot>
                  <tr v-for="invoiceheader in invoiceitems.slice(0,1)">
                      <th class="text-center">@{{ invoiceheader.invoiceh.total_fulls.toFixed(3) }}</th>
                      <th class="text-center"></th>
                      <th class="text-center"></th>
                      <th class="text-center"></th>
                      <th class="text-center">@{{ invoiceheader.invoiceh.total_pieces }}</th>
                      <th class="text-center"></th>
                      <th class="text-center"></th>
                      <th class="text-center"></th>
                      <th class="text-center"></th>
                      <th class="text-center">@{{ invoiceheader.invoiceh.total_stems }}</th>
                      <th class="text-center">@{{ invoiceheader.invoiceh.total_bunches }}</th>
                      <th class="text-center"></th>
                      <th class="text-center">@{{ invoiceheader.invoiceh.total.toFixed(2) }}</th>
                  </tr>
              </tfoot>
             </table>
           </div>
           <!-- /.col -->
         </div>
         <!-- /.row -->

         

         
       </div>
       <!-- /. End invoice header -->
       


       <!-- Modal Update Master Invoice Items -->
       <div class="modal fade" id="editarItem" tabindex="-1" aria-labelledby="editarItemLabel" aria-hidden="true">
         <div class="modal-dialog modal-xl">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="editarItemLabel">Editar item de la factura</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form method="POST" v-on:submit.prevent="updateInvoiceItem(fillInvoiceItem.id)">
                  <div class="modal-body">
                     @include('masterinvoice.editFormItems')
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                     <button type="submit" class="btn btn-outline-warning" id="createMasterInvoice" data-toggle="tooltip" data-placement="top" title="Crear Empresa">
                        <i class="fas fa-sync"></i> Actualizar
                  </button>
                  </div>
               </form>
            </div>
         </div>
         </div>
      </div>
      @endif
   </div>
</section>
@endcan

@section('scripts')
<script>
    $(document).ready(function(){
         $(".grupo").keyup(function()
         {
            var stems = $('#stems').val();
            var stems_p_bunches = $('#stems_p_bunches').val();
            var bunches = parseFloat(stems) / parseFloat(stems_p_bunches);
            $('#bunches').val(parseFloat(bunches));
            // Total
            var price = $('#price').val();
            var total = parseFloat(stems) * parseFloat(price);
            $('#total').val(parseFloat(total));

            /// Edit
            var Editstems = $('#Editstems').val();
            var Editstems_p_bunches = $('#Editstems_p_bunches').val();
            var Editbunches = parseFloat(Editstems) / parseFloat(Editstems_p_bunches);
            $('#Editbunches').val(parseFloat(Editbunches));
            // Total
            var Editprice = $('#Editprice').val();
            var Edittotal = parseFloat(Editstems) * parseFloat(Editprice);
            $('#Edittotal').val(parseFloat(Edittotal));
         });
         $('.client_confirm').hide();
         $('#customSwitch3').on('change', function() {
            if ($(this).is(':checked') ) {
               $('.client_confirm').show();
            } else {
               $('.client_confirm').hide();
            }
         });
         $('#EditcustomSwitch3').on('change', function() {
            if ($(this).is(':checked') ) {
               $('.client_confirm').show();
            } else {
               $('.client_confirm').hide();
            }
         });
    });

</script>

@endsection

@endsection
