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
                      
                          
                      
                      @for ($i = 1; $i <= 24; $i++)
                      <div class="row">
                        <div class="col">
                          {{ $i }}
                          
                          <button type="button" class="btn btn-xs btn-primary pull-right" data-toggle="modal" data-target="#myModal{{ $i }}" data-toggle="tooltip" data-placement="top" title="Agregar nuevas paletas"><i class="fas fa-plus-circle"></i> Agregar Paleta - Espacio {{ $i }}</button>
                          <!-- Modal Pallets -->
                          <div class="modal fade" id="myModal{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title" id="agregarItemLabel">Contenedor {{ $load->shipment }} - Espacio {{ $i }}</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                                      <div class="modal-body">
                                          @include('custom.message')

                                          {{ Form::open(['route' => 'sketches.store', 'class' => 'form-horizontal']) }}
                                          <div class="modal-body">
                                              {{ Form::hidden('id_load', $load->id) }}
                                              {{ Form::hidden('space', $i) }}
                                              {!! Form::hidden('id_user', \Auth::user()->id) !!}
                                              {!! Form::hidden('update_user', \Auth::user()->id) !!}

                                              {{ Form::label('id_pallet', 'Paleta', ['class' => 'control-label']) }}
                                              {{ Form::select('id_pallet', $palletsSelect, null, ['class' => 'form-control', 'placeholder' => 'Seleccione paleta']) }}
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
                        <div class="col">
                          {{ $i+=1 }}
                          @php
                              $j = $i;
                          @endphp
                          <button type="button" class="btn btn-xs btn-primary pull-right" data-toggle="modal" data-target="#myModal{{ $j }}" data-toggle="tooltip" data-placement="top" title="Agregar nuevas paletas"><i class="fas fa-plus-circle"></i> Agregar Paleta - Espacio {{ $j }}</button>
                          <!-- Modal Pallets -->
                          <div class="modal fade" id="myModal{{ $j }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title" id="agregarItemLabel">Contenedor {{ $load->shipment }} - Espacio {{ $j }}</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                                      <div class="modal-body">
                                          @include('custom.message')

                                          {{ Form::open(['route' => 'sketches.store', 'class' => 'form-horizontal']) }}
                                          <div class="modal-body">
                                              {{ Form::hidden('id_load', $load->id) }}
                                              {{ Form::hidden('space', $j) }}
                                              {!! Form::hidden('id_user', \Auth::user()->id) !!}
                                              {!! Form::hidden('update_user', \Auth::user()->id) !!}

                                              {{ Form::label('id_pallet', 'Paleta', ['class' => 'control-label']) }}
                                              {{ Form::select('id_pallet', $palletsSelect, null, ['class' => 'form-control', 'placeholder' => 'Seleccione paleta']) }}
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
                      </div>
                      @endfor
                      
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
