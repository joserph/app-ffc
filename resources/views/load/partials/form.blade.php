<div class="form-row">
   <div class="form-group col-md-3">
      {{ Form::label('shipment', 'Carga') }}
      {{ Form::text('shipment', null, ['class' => 'form-control']) }}
   </div>
   <div class="form-group col-md-3">
      {{ Form::label('bl', 'BL') }}
      {{ Form::text('bl', null, ['class' => 'form-control']) }}
   </div>
   <div class="form-group col-md-3">
      {{ Form::label('carrier', 'Transportista') }}
      {{ Form::text('carrier', null, ['class' => 'form-control']) }}
   </div>
   <div class="form-group col-md-3">
      {{ Form::label('date', 'Fecha') }}
      {{ Form::date('date', null, ['class' => 'form-control']) }}
   </div>
   {{ Form::hidden('id_user', Auth::user()->id) }}
   {{ Form::hidden('update_user', Auth::user()->id) }}
</div>
    