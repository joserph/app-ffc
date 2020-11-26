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

         <!-- Table row -->
         <div class="row">
           <div class="col-12 table-responsive">
             <table class="table table-striped">
               <thead>
               <tr>
                 <th>Qty</th>
                 <th>Product</th>
                 <th>Serial #</th>
                 <th>Description</th>
                 <th>Subtotal</th>
               </tr>
               </thead>
               <tbody>
               <tr>
                 <td>1</td>
                 <td>Call of Duty</td>
                 <td>455-981-221</td>
                 <td>El snort testosterone trophy driving gloves handsome</td>
                 <td>$64.50</td>
               </tr>
               <tr>
                 <td>1</td>
                 <td>Need for Speed IV</td>
                 <td>247-925-726</td>
                 <td>Wes Anderson umami biodiesel</td>
                 <td>$50.00</td>
               </tr>
               <tr>
                 <td>1</td>
                 <td>Monsters DVD</td>
                 <td>735-845-642</td>
                 <td>Terry Richardson helvetica tousled street art master</td>
                 <td>$10.70</td>
               </tr>
               <tr>
                 <td>1</td>
                 <td>Grown Ups Blue Ray</td>
                 <td>422-568-642</td>
                 <td>Tousled lomo letterpress</td>
                 <td>$25.99</td>
               </tr>
               </tbody>
             </table>
           </div>
           <!-- /.col -->
         </div>
         <!-- /.row -->

         <div class="row">
           <!-- accepted payments column -->
           <div class="col-6">
             <p class="lead">Payment Methods:</p>
             <img src="../../dist/img/credit/visa.png" alt="Visa">
             <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
             <img src="../../dist/img/credit/american-express.png" alt="American Express">
             <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

             <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
               Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
               plugg
               dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
             </p>
           </div>
           <!-- /.col -->
           <div class="col-6">
             <p class="lead">Amount Due 2/22/2014</p>

             <div class="table-responsive">
               <table class="table">
                 <tr>
                   <th style="width:50%">Subtotal:</th>
                   <td>$250.30</td>
                 </tr>
                 <tr>
                   <th>Tax (9.3%)</th>
                   <td>$10.34</td>
                 </tr>
                 <tr>
                   <th>Shipping:</th>
                   <td>$5.80</td>
                 </tr>
                 <tr>
                   <th>Total:</th>
                   <td>$265.24</td>
                 </tr>
               </table>
             </div>
           </div>
           <!-- /.col -->
         </div>
         <!-- /.row -->

         <!-- this row will not appear when printing -->
         <div class="row no-print">
           <div class="col-12">
             <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
             <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
               Payment
             </button>
             <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
               <i class="fas fa-download"></i> Generate PDF
             </button>
           </div>
         </div>
       </div>
       <!-- /. End invoice header -->
       @endif

   </div>
</section>
@endcan
@endsection
