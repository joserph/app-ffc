@extends('layouts.principal')

@section('content')
<section class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1>Plano de Carga</h1>
         </div>
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
               <li class="breadcrumb-item"><a href="{{ route('load.index') }}">Cargas</a></li>
               <li class="breadcrumb-item"><a href="{{ route('load.show', $load->id) }}">{{ $load->bl }}</a></li>
               <li class="breadcrumb-item active">Plano de Carga</li>
            </ol>
         </div>
      </div>
   </div><!-- /.container-fluid -->
</section>

  <!-- Main content -->
<section class="content">
   @include('custom.message') 
   <div class="container-fluid">
      <div class="row">
         <!-- /.col -->
         <div class="col-md-12">
                {{ Form::open(['route' => 'sketches.store']) }}
                    {!! Form::hidden('id_load', $load->id) !!}
                    {!! Form::hidden('id_user', \Auth::user()->id) !!}
                     {!! Form::hidden('update_user', \Auth::user()->id) !!}
                    @if($space != 1)
                    {!! Form::label('quantity', 'Seleccione la cantidad de espacios') !!}
                    {!! Form::select('quantity', [
                        '18' => '18', 
                        '20' => '20',
                        '22' => '22',
                        '24' => '24'
                        ], 20, ['placeholder' => 'Seleccione espacios', 'class' => 'form-control col-md-3']) !!}
                    @endif
                    <button type="submit" class="btn btn-sm btn-primary" @if($space == 1) disabled @endif><i class="fas fa-plus-circle"></i> Generar espacios</button>
                {{ Form::close() }}
            <div class="card">
                
                <div class="card-header">
                    Plano de Carga contenedor #{{ $load->shipment }}

                    

                </div>
                <div class="card-body table-responsive p-0">
                    <div class="container">
                      
                          
                      
                     
                      
                </div>
                </div>
               
               <!-- /.card-body -->
            </div>
            <div class="card-footer text-muted">
               <ul class="list-group list-group-flush">
                  @foreach ($pallets as $item)
                     <li class="list-group-item">{{ $item->number }} Cantidad de cajas: {{ $item->quantity }} - {{ $item->usda ? 'USDA' : ''}}</li>
                  @endforeach
                </ul>
             </div>
            <!-- /.card -->
         </div>
      </div>
   </div>
</section>
@endsection
