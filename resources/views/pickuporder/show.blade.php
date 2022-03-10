@extends('layouts.principal')

@section('title') Lista de Pick Up Order | Sistema de Carguera v1.1 @stop

@section('content')
<section class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1>Pick Up Order Carrier #{{ $pickuporder->carrier_num }}</h1>
         </div>
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
               <li class="breadcrumb-item active"><a href="{{ route('pickuporder.index') }}">Pick Up Orders</a></li>
               <li class="breadcrumb-item active">Carrier #{{ $pickuporder->carrier_num }}</li>
            </ol>
         </div>
      </div>
   </div><!-- /.container-fluid -->
</section>

<section class="content">
   <div class="container-fluid">
      
        <div class="invoice p-3 mb-3">

            <div class="row">
                <div class="col-12">
                    <h4>
                        <i class="fas fa-globe"></i> Pick Up Order Carrier #{{ $pickuporder->carrier_num }}
                        <small class="float-right">Date: {{ $pickuporder->date }}</small>
                    </h4>
                </div>
            </div>
            
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    Pick Up Locations:
                    <address>
                        <strong>{{ $pickuporder->pick_up_location }}</strong><br>
                        {{ $pickuporder->pick_up_address }}<br>
                    </address>
                </div>
            
                <div class="col-sm-4 invoice-col">
                    Consigned To:
                    <address>
                        <strong>{{ $pickuporder->consigned_to }}</strong><br>
                        {{ $pickuporder->drop_off_address }}<br>
                    </address>
                </div>
            
                <div class="col-sm-4 invoice-col">
                    <b>Carrier #{{ $pickuporder->carrier_num }}</b><br>
                    <b>Loading Starting Date:</b> {{ $pickuporder->loading_date }} / {{ $pickuporder->loading_hour }}<br>
                    <b>Carrier Company:</b> {{ $pickuporder->carrier_company }}<br>
                    <b>Diver Name:</b> {{ $pickuporder->driver_name }}
                </div>
        
            </div>
        </div>
        <hr>
        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#agregarItem">
            <i class="fas fa-plus-circle"></i> Crear Item
        </button>

        @include('custom.message')

        <div class="modal fade" id="agregarItem" tabindex="-1" aria-labelledby="agregarItemLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="agregarItemLabel">Agregar item de Pick Up Order</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     @include('custom.message')
                     {{ Form::open(['route' => 'pickuporderitem.store', 'class' => 'form-horizontal']) }}
                        <div class="modal-body">
                           @include('pickuporderItem.partials.form')
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                           <button type="submit" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Crear Empresa">
                              <i class="fas fa-plus-circle"></i> Crear
                           </button>
                        </div>
                     {{ Form::close() }}
                  </div>
               </div>
            </div>
        </div>


    </div>
</section>
@endsection
