<div class="form-row">
   <div class="form-group col-md-4">
      {{ Form::label('shipment', 'Carga') }}
      {{ Form::text('shipment', null, ['class' => 'form-control']) }}
   </div>
   <div class="form-group col-md-4">
      {{ Form::label('bl', 'BL') }}
      {{ Form::text('bl', null, ['class' => 'form-control']) }}
   </div>
   <div class="form-group col-md-4">
      {{ Form::label('carrier', 'Transportista') }}
      {{ Form::text('carrier', null, ['class' => 'form-control']) }}
   </div>
   <div class="form-group col-md-4">
      {{ Form::label('date', 'Fecha Salida') }}
      {{ Form::date('date', null, ['class' => 'form-control']) }}
   </div>
   <div class="form-group col-md-4">
      {{ Form::label('arrival_date', 'Fecha llegada') }}
      {{ Form::date('arrival_date', null, ['class' => 'form-control']) }}
   </div>
   
   <div class="form-group col-md-6">
      {{ Form::label('code_deep', 'Código Termografo Fondo') }}
      {{ Form::text('code_deep', null, ['class' => 'form-control']) }}
   </div>
   <div class="form-group col-md-6">
      {{ Form::label('brand_deep', 'Marca Termografo Fondo') }}
      {{ Form::text('brand_deep', null, ['class' => 'form-control']) }}
   </div>
   <div class="form-group col-md-6">
      {{ Form::label('code_door', 'Código Termografo Puerta') }}
      {{ Form::text('code_door', null, ['class' => 'form-control']) }}
   </div>
   <div class="form-group col-md-6">
      {{ Form::label('brand_door', 'Marca Termografo Puerta') }}
      {{ Form::text('brand_door', null, ['class' => 'form-control']) }}
   </div>
   {{ Form::hidden('id_user', Auth::user()->id) }}
   {{ Form::hidden('update_user', Auth::user()->id) }}
</div>
    