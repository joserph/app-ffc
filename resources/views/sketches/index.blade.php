@extends('layouts.principal')

@section('title') Plano de Carga | Sistema de Carguera v1.1 @stop

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
                @if($space == 1)
                {!! Form::open(['route' => ['sketches.destroy', $load->id], 'method' => 'DELETE', 'onclick' => 'return confirm("¿Seguro de revertir los espacios?")']) !!}
                  <button class="btn btn-sm btn-outline-warning" data-toggle="tooltip" data-placement="top" title="Revertir espacios"><i class="fas fa-history"></i> Revertir Espacios</button>
               {!! Form::close() !!}
                @endif
            <div class="card">
                
                <div class="card-header">
                    Plano de Carga contenedor #{{ $load->shipment }}
                </div>
                <div class="card-body table-responsive p-0">
                  <div class="container">
                     <div class="row">
                        @foreach ($sketches as $key => $item)
                           <div class="col" style="height: 100px; border-style: solid; border-radius: 10px; border-width: 5px; padding-right: 0; padding-left: 0;">
                              <div class="espacio" style="height: 100%; width: 100%;">
                                 @foreach ($sketchPercent as $percent)
                                    @if ($item->id_pallet == $percent->id_pallet)
                                             @if ($percent->percent < 10)
                                                @php
                                                   $newPercent = $percent->percent + 10;
                                                @endphp
                                             @elseif($percent->percent > 90 && $percent->percent < 100)
                                                @php
                                                   $newPercent = $percent->percent - 10;
                                                @endphp
                                             @else
                                                @php
                                                   $newPercent = $percent->percent;
                                                @endphp
                                             @endif
                                             <div style="height: {{ $newPercent }}%; 
                                             background-color: 
                                             @foreach ($colors as $color)
                                                @if ($color->id_type == $percent->id_client)
                                                {{ $color->color}}
                                                @endif
                                             @endforeach
                                             ">{{ $percent->client->name }}</div>
                                          
                                       
                                    @endif
                                 @endforeach
                                 
                              </div>
                           </div>
                           @if($key % 2 != 0)
                              <div class="w-100"></div>
                           @endif
                        @endforeach
                     </div>
                     <hr>
                     <div class="row">
                        @foreach ($sketches as $key => $item)
                        <div class="col">
                           <div class="card @if($item->id_pallet) card-success @else card-default @endif collapsed-card">
                              <div class="card-header">
                                 <h3 class="card-title">
                                    Espacio 
                                    <span class="badge rounded-pill bg-dark">{{ $item->space }}</span>
                                    @if($item->id_pallet)
                                       <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal{{ $key }}" data-toggle="tooltip" data-placement="top" title="Editar paleta en espacio">
                                          <i class="fas fa-edit"></i> Editar
                                          
                                       </button>
                                       Paleta <span class="badge rounded-pill bg-info text-dark">{{ $item->pallet->number }}</span>
                                    @else 
                                       <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal{{ $key }}" data-toggle="tooltip" data-placement="top" title="Agregar paleta en espacio">
                                          <i class="fas fa-plus-circle"></i> Agregar 
                                          
                                       </button>
                                    @endif
                                 </h3>
                                 
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
                                    <!-- /Modal Pallets -->

                                    <!-- Edit modal -->
                                    <div class="modal fade" id="editModal{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
                                       <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                   <h5 class="modal-title text-dark" id="agregarItemLabel">Contenedor {{ $load->shipment }} - Espacio {{ $item->space }}</h5>
                                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                   <span aria-hidden="true">&times;</span>
                                                   </button>
                                             </div>
                                             <div class="modal-body">
                                                   {{ Form::open(['route' => 'sketches.store', 'class' => 'form-horizontal']) }}
                                                   <div class="modal-body">
                                                      {!! Form::hidden('update_user', \Auth::user()->id) !!}
                                                      {{ Form::hidden('id', $item->id) }}
                                                      {{ Form::label('id_pallet', 'Paleta', ['class' => 'control-label text-dark']) }}
                                                      {{ Form::select('id_pallet', $palletsSelect, null, ['class' => 'form-control', 'placeholder' => 'Quitar Paleta']) }}
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
                                    <!-- /Edit modal -->
                                <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                  </button>
                                </div>
                                <!-- /.card-tools -->
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body" style="display: none;">
                                 <div class="table-responsive">
                                    @if($item->id_pallet)
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
                                                            <small>{{ Str::limit(strtoupper($farm->name), '17') }}</small>
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
                                    @endif
                                 </div>
                                    
                                    
                              </div>
                              <!-- /.card-body -->
                            </div>
                        </div>
                        @if($key % 2 != 0)
                           <div class="w-100"></div>
                        @endif
                        @endforeach
                     </div>
                     
                          
                      
                     
                      
                  </div>
                </div>
               
               <!-- /.card-body -->
            </div>
            <div class="card-footer text-muted">
               <div class="container">
                  <div class="row">
                     @php
                        $totalBoxes = 0;
                     @endphp
                  @foreach ($pallets as $item)
                     
                     
                          <div class="col-sm-6">
                           <li class="list-group-item d-flex justify-content-between align-items-center">
                              Paleta - {{ $item->number }}
                              <span class="badge bg-primary rounded-pill">{{ $item->quantity }} {{ $item->usda ? '- USDA' : ''}}</span>
                              </li>
                          </div>
                          @php
                              $totalBoxes+= $item->quantity;
                           @endphp

                  @endforeach
                  <hr>

                  <div class="col-sm-6">
                     <li class="list-group-item list-group-item-info d-flex justify-content-between align-items-center">
                        Total de cajas: 
                        <span class="badge bg-dark rounded-pill">{{ $totalBoxes }}</span>
                        </li>
                    </div>
               </div>
            </div>
             </div>
            <!-- /.card -->
         </div>
      </div>
   </div>
</section>
@endsection
