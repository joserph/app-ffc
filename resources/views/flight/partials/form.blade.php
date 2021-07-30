<div class="form-row">
    <div class="form-group col-md-3">
       {{ Form::label('awb', 'AWB') }}
       {{ Form::text('awb', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group col-md-3">
       {{ Form::label('carrier', 'Transportista') }}
       {{ Form::text('carrier', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group col-md-3">
       {{ Form::label('date', 'Fecha Salida') }}
       {{ Form::date('date', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group col-md-3">
       {{ Form::label('arrival_date', 'Fecha llegada') }}
       {{ Form::date('arrival_date', null, ['class' => 'form-control']) }}
    </div>
    {{ Form::hidden('id_user', Auth::user()->id) }}
    {{ Form::hidden('update_user', Auth::user()->id) }}
 </div>
     