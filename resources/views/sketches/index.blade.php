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
