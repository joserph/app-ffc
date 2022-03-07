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
        
    </div>
</section>
@endsection
