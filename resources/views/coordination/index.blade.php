@extends('layouts.principal')

@section('content')
<section class="content-header">
    <div class="container-fluid">
       <div class="row mb-2">
          <div class="col-sm-6">
             <h1>Coordinaciones</h1>
          </div>
          <div class="col-sm-6">
             <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('load.index') }}">Cargas</a></li>
                <li class="breadcrumb-item active">Crear Carga</li>
             </ol>
          </div>
       </div>
    </div><!-- /.container-fluid -->
 </section>


  <!-- Main content -->
<section class="content">
   <div class="container-fluid">
      <div class="row justify-content-center">
         <div class="col-12">

            @include('custom.message') 

            <div class="card">
               <div class="card-header">
                  Coordinaciones
               </div>
               <div class="card-body">
                  <h5 class="card-title">{{ $load->bl }}</h5>
                  <p class="card-text">{{ $company->name }}</p>
                  <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#agregarItem">
                     <i class="fas fa-plus-circle"></i> Crear Item
               </button>
               </div>
               <div class="card-footer">
                  <!-- tabla de coordinaciones -->
                  <div class="table-responsive">
                     <table class="table table-hover">
                        @foreach($clientsCoordination as  $key => $client)
                        <thead>
                           <tr>
                               <th colspan="14"></th>
                           </tr>
                       </thead>
                       <thead>
                           <tr>
                              <th class="text-center medium-letter" colspan="14">{{ $client['name'] }}</th>
                           </tr>
                     </thead>
                        <thead>
                           <tr>
                              <th scope="col">Farms</th>
                              <th scope="col">HAWB</th>
                              <th scope="col">Varieties</th>
                              <th scope="col">Pcs</th>
                              <th scope="col">HB</th>
                              <th scope="col">QB</th>
                              <th scope="col">EB</th>
                              <th scope="col">Box</th>
                              <th scope="col">HB</th>
                              <th scope="col">QB</th>
                              <th scope="col">EB</th>
                              <th scope="col">Box</th>
                              <th scope="col">Dev</th>
                              <th scope="col">Missing</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach ($coordinations as $item)
                              @if($client['id'] == $item->id_client)
                                 <tr>
                                    <td>{{ $item->id_farm }}</td>
                                    <td>{{ $item->hawb }}</td>
                                    <td>{{ $item->variety_id }}</td>
                                    <td>{{ $item->pieces }}</td>
                                    <td>{{ $item->hb }}</td>
                                    <td>{{ $item->qb }}</td>
                                    <td>{{ $item->eb }}</td>
                                    <td>{{ $item->fulls }}</td>
                                    <td>{{ $item->hb_r }}</td>
                                    <td>{{ $item->qb_r }}</td>
                                    <td>{{ $item->eb_r }}</td>
                                    <td>{{ $item->fulls_r }}</td>
                                    <td>{{ $item->returns }}</td>
                                    <td>{{ $item->missing }}</td>
                                 </tr>
                              @endif
                           @endforeach
                           
                        </tbody>
                        @endforeach
                     </table>
                  </div>
                  <!-- fin tabla de coordinaciones -->
               </div>
            </div>
            
         </div>
         
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
                     {{ Form::open(['route' => 'coordination.store', 'class' => 'form-horizontal']) }}
                        <div class="modal-body">
                           @include('coordination.form')
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
</section>
@endsection
