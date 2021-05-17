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
   <div class="container-fluid">
      <div class="row">
         <!-- /.col -->
         <div class="col-md-12">
            <div class="card">
               
                <div class="card-header">
                    Plano de Carga contenedor #{{ $load->shipment }}
                </div>
                <div class="card-body table-responsive p-0">
                    <div class="container">
                        <div class="row">
                          <div class="col">
                            <button type="button" class="btn btn-xs btn-primary pull-right" data-toggle="modal" data-target="#myModal" data-toggle="tooltip" data-placement="top" title="Agregar nuevas paletas"><i class="fas fa-plus-circle"></i> Agregar Paleta</button>
                            <!-- Modal Pallets -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
           <div class="modal-header">
              <h5 class="modal-title" id="agregarItemLabel">Contenedor {{ $load->shipment }}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
              </button>
           </div>
          <div class="modal-body">
              @include('custom.message')

              {{ Form::open(['route' => 'pallets.store', 'class' => 'form-horizontal']) }}
                 <div class="modal-body">
                   
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
                           {{ Form::label('id_pallet', 'Paleta', ['class' => 'control-label']) }}
                           {{ Form::select('id_pallet', $palletsSelect, null, ['class' => 'form-control', 'placeholder' => 'Seleccione paleta']) }}
                          </div>
                          <div class="col">
                            2
                          </div>
                        </div>
                        <div class="row">
                            <div class="col">
                              3
                            </div>
                            <div class="col">
                              4
                            </div>
                          </div>
                      <div class="row">
                        <div class="col">
                          5
                        </div>
                        <div class="col">
                          6
                        </div>
                      </div>
                      <div class="row">
                          <div class="col">
                            7
                          </div>
                          <div class="col">
                            8
                          </div>
                        </div>
                    <div class="row">
                        <div class="col">
                          9
                        </div>
                        <div class="col">
                          10
                        </div>
                      </div>
                      <div class="row">
                          <div class="col">
                            11
                          </div>
                          <div class="col">
                            12
                          </div>
                        </div>
                    <div class="row">
                        <div class="col">
                          13
                        </div>
                        <div class="col">
                          14
                        </div>
                      </div>
                      <div class="row">
                          <div class="col">
                            15
                          </div>
                          <div class="col">
                            16
                          </div>
                        </div>
                    <div class="row">
                        <div class="col">
                          17
                        </div>
                        <div class="col">
                          18
                        </div>
                      </div>
                      <div class="row">
                          <div class="col">
                            19
                          </div>
                          <div class="col">
                            20
                          </div>
                        </div>
                    <div class="row">
                        <div class="col">
                          21
                        </div>
                        <div class="col">
                          22
                        </div>
                      </div>
                      <div class="row">
                          <div class="col">
                            23
                          </div>
                          <div class="col">
                            24
                          </div>
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
