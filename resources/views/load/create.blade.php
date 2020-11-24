@extends('layouts.principal')

@section('content')
<section class="content-header">
    <div class="container-fluid">
       <div class="row mb-2">
          <div class="col-sm-6">
             <h1>Crear Carga
                
             </h1>
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



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Crear Carga
                </div>

                <div class="card-body">
                    
                   @include('custom.message')

                     {{ Form::open(['route' => 'load.store', 'class' => 'form-horizontal']) }}
                        @include('load.partials.form')
                        <hr>
                        <div class="form-group row">
                           <div class="col-sm-12">
                              <button type="submit" class="btn btn-outline-primary"><i class="fas fa-plus-circle"></i></button>
                           </div>
                        </div>
                     {{ Form::close() }}
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
