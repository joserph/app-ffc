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
                     
                     <div class="row">
                        @foreach ($sketches as $key => $item)
                        <div class="col-sm-6">
                           <div class="card card-success collapsed-card">
                              <div class="card-header">
                                <h3 class="card-title">Espacio <span class="badge rounded-pill bg-dark">{{ $item->space }}</span> @if($item->id_pallet)<button type="button" class="btn btn-warning btn-sm">Editar</button> Paleta #<span class="badge rounded-pill bg-info text-dark">5555</span> @else <button type="button" class="btn btn-sm btn-primary pull-right" data-toggle="modal" data-target="#myModal{{ $key }}" data-toggle="tooltip" data-placement="top" title="Agregar paleta en espacio"><i class="fas fa-plus-circle"></i> Agregar Paleta en Espacio <span class="badge bg-secondary">{{ $item->space }}</span></button>@endif</h3>
                                 
                                 <!-- Modal Pallets -->
                                    <div class="modal fade" id="myModal{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                       <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                   <h5 class="modal-title text-dark" id="agregarItemLabel">Contenedor {{ $load->shipment }} - Espacio {{ $item->space }}</h5>
                                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                   <span aria-hidden="true">&times;</span>
                                                   </button>
                                             </div>
                                             <div class="modal-body">
                                                   @include('custom.message')

                                                   {{ Form::open(['route' => 'sketches.store', 'class' => 'form-horizontal']) }}
                                                   <div class="modal-body">
                                                      {!! Form::hidden('update_user', \Auth::user()->id) !!}
                                                      {{ Form::hidden('id', $item->id) }}
                                                      {{ Form::label('id_pallet', 'Paleta', ['class' => 'control-label text-dark']) }}
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
                                <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                  </button>
                                </div>
                                <!-- /.card-tools -->
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body" style="display: none;">
                                 <div class="table-responsive">
                                    <table class="table table-sm table table-bordered">
                                       <thead>
                                       <tr>
                                          <th class="text-center">Finca</th>
                                          <th class="text-center">Cliente</th>
                                          <th class="text-center">Piso</th>
                                          <th class="text-center">HB</th>
                                          <th class="text-center">QB</th>
                                          <th class="text-center">EB</th>
                                          <th class="text-center">Total</th>
                                       </tr>
                                       </thead>
                                       <tbody>
                                          @php
                                             $hb = 0; $qb = 0; $eb = 0; $total = 0;
                                          @endphp
                                          @foreach ($palletsItems as $item2)
                                             @if($item->id_pallet == $item2->id_pallet)
                                                @php 
                                                   $hb+=$item2->hb;
                                                   $qb+=$item2->qb;
                                                   $eb+=$item2->eb;
                                                   $total+=$item2->quantity;
                                                @endphp
                                                <tr>
                                                   <td>
                                                      @foreach ($farms as $farm)
                                                         @if($item2->id_farm == $farm->id)
                                                            {{ Str::limit(strtoupper($farm->name), '17') }}
                                                         @endif
                                                      @endforeach
                                                   </td>
                                                   <td class="text-center">
                                                      @foreach ($clients as $client)
                                                         @if($item2->id_client == $client->id)
                                                         <small>{{ Str::limit(str_replace('SAG-', '', $client->name), '8') }}</small>
                                                         @endif
                                                      @endforeach
                                                   </td>
                                                   <td class="text-center">
                                                      @if($item2->piso == 1)
                                                      <span class="badge badge-warning">SI</span>
                                                      @endif
                                                   </td>
                                                   <td class="text-center">{{ $item2->hb }}</td>
                                                   <td class="text-center">{{ $item2->qb }}</td>
                                                   <td class="text-center">{{ $item2->eb }}</td>
                                                   <td class="text-center">{{ $item2->quantity }}</td>
                                                </tr>
                                                
                                             @endif
                                          @endforeach
                                       </tbody>
                                       <tfoot>
                                          <tr>
                                             <th colspan="3" class="text-center">Totales</th>
                                             <th class="text-center">{{ $hb }}</th>
                                             <th class="text-center">{{ $qb }}</th>
                                             <th class="text-center">{{ $eb }}</th>
                                             <th class="text-center">{{ $total }}</th>
                                          </tr>
                                      </tfoot>
                                    </table>
                                 </div>
                                    
                                    
                              </div>
                              <!-- /.card-body -->
                            </div>
                        </div>
                        @endforeach
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
