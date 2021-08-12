<div class="form-row">
    <div class="form-group col-md-3">
       {{ Form::label('type', 'Tipo') }}
       {{ Form::select('type', [
          'client' => 'Cliente',
          'farm' => 'Finca'
          ], null, ['class' => 'form-control', 'placeholder' => 'Seleccione tipo', 'id' => 'tipo']) }}
    </div>
    <div class="col-md-3 form-group finca">
      {{ Form::label('farm', 'Finca', ['class' => 'control-label']) }}
      {{ Form::select('farm', $farms, null, ['class' => 'form-control select-farm', 'placeholder' => 'Seleccione finca']) }}
    </div>
    <div class="col-md-3 form-group cliente">
      {{ Form::label('client', 'Cliente', ['class' => 'control-label']) }}
      {{ Form::select('client', $clients, null, ['class' => 'form-control select-client', 'placeholder' => 'Seleccione cliente']) }}
  </div>
    <div class="form-group col-md-3">
       {{ Form::label('color', 'Color') }}
        <input type="color" name="color" class="form-control">
    </div>
    <div class="form-group col-md-3">
      {{ Form::label('label', 'Etiqueta') }}
      {{ Form::select('label', [
         'square' => 'Cuadrado',
         'point' => 'Punto'
         ], null, ['class' => 'form-control', 'placeholder' => 'Seleccione Etiqueta']) }}
   </div>
    {{ Form::hidden('id_user', Auth::user()->id) }}
    {{ Form::hidden('update_user', Auth::user()->id) }}
 </div>
 @section('scripts')
 <script>
   $(document).ready(function(){
        var tipo = $('#tipo').val();
        $('.cliente').hide();
        $('.finca').hide();
        $('#tipo').on('change', function() {
            if($('#tipo').val() == 'client'){
               console.log('cliente');
               $('.cliente').show();
               $('.finca').hide();
            }else if($('#tipo').val() == 'farm'){
               $('.finca').show();
               $('.cliente').hide();
               console.log('finca');
            }
        });
      
   });
 </script>
 @endsection
     