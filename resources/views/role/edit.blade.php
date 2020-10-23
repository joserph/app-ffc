@extends('layouts.principal')

@section('content')
<section class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1>Editar Role
               
            </h1>
         </div>
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
               <li class="breadcrumb-item active"><a href="{{ route('role.index') }}">Role(s)</a></li>
               <li class="breadcrumb-item active">Editar Role</li>
            </ol>
         </div>
      </div>
   </div><!-- /.container-fluid -->
</section>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-warning">
                <div class="card-header">Editar role
                </div>

                <div class="card-body">
                    
                   @include('custom.message')

                    {{ Form::model($role, ['route' => ['role.update', $role->id], 'class' => 'form-horizontal', 'method' => 'PUT']) }}
                        @include('role.partials.formE')
                        <hr>
                        <div class="form-group row">
                            <div class="col-sm-12">
                               <button type="submit" class="btn btn-sm btn-warning"><i class="fas fa-sync"></i> Actualizar</button>
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
