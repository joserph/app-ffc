<div class="form-group">
    <div class="col-sm-4">
        {{ Form::label('id_farm', 'Finca', ['class' => 'control-label']) }}
        {{ Form::select('id_farm', $farms, null, ['class' => 'form-control select-farm', 'placeholder' => 'Seleccione finca', 'style' => 'width: 200px', 'v-model' => 'id_farm']) }}
    </div>
    <div class="col-sm-4">
        {{ Form::label('id_client', 'Cliente', ['class' => 'control-label']) }}
        {{ Form::select('id_client', $clients, null, ['class' => 'form-control select-client', 'placeholder' => 'Seleccione cliente', 'v-model' => 'id_client']) }}
    </div>
    <div class="col-sm-4">
        {{ Form::label('description', 'Descripción', ['class' => 'control-label']) }}
        {{ Form::select('description', $varieties, null, ['class' => 'form-control select-product', 'placeholder' => 'Seleccione tipo', 'v-model' => 'description']) }}
    </div>
</div>
<div class="form-group">
    
    <div class="col-sm-2">
        {{ Form::label('hb', 'HB', ['class' => 'control-label']) }}
        {{ Form::number('hb', null, ['class' => 'form-control', 'v-model' => 'hb']) }}
    </div>
    <div class="col-sm-2">
        {{ Form::label('qb', 'QB', ['class' => 'control-label']) }}
        {{ Form::number('qb', null, ['class' => 'form-control', 'v-model' => 'qb']) }}
    </div>
    <div class="col-sm-2">
        {{ Form::label('eb', 'EB', ['class' => 'control-label']) }}
        {{ Form::number('eb', null, ['class' => 'form-control', 'v-model' => 'eb']) }}
    </div>
    <div class="col-sm-3">
        {{ Form::label('hawb', 'HAWB', ['class' => 'control-label']) }}
        {{ Form::text('hawb', null, ['class' => 'form-control', 'v-model' => 'hawb']) }}
    </div>
    
    <div class="col-sm-3">
        {{ Form::label('stems_p_bunches', 'Tallos por bonches', ['class' => 'control-label']) }}
        {{ Form::select('stems_p_bunches', [
            '10' => '10',
            '12' => '12',
            '25' => '25',
            ], '25', ['class' => 'form-control grupo', 'id' => 'stems_p_bunches', 'v-model' => 'stems_p_bunches']) }}
    </div>
</div>
<div class="form-group">
    <div class="col-sm-3">
        {{ Form::label('stems', 'Tallos', ['class' => 'control-label']) }}
        {{ Form::number('stems', null, ['class' => 'form-control grupo', 'id' => 'stems', 'v-model' => 'stems']) }}
    </div>
    <div class="col-sm-3">
        {{ Form::label('bunches', 'Bonches', ['class' => 'control-label']) }}
        {{ Form::number('bunches', null, ['class' => 'form-control', 'id' => 'bunches', 'v-model' => 'bunches']) }}
    </div>
    <div class="col-sm-3">
        {{ Form::label('price', 'Precio', ['class' => 'control-label']) }}
        {{ Form::text('price', null, ['class' => 'form-control grupo', 'id' => 'price', 'v-model' => 'price']) }}
    </div>
    <div class="col-sm-3">
        {{ Form::label('total', 'Total', ['class' => 'control-label']) }}
        {{ Form::text('total', null, ['class' => 'form-control', 'id' => 'total', 'v-model' => 'total']) }}
        <span id="helpBlock" class="help-block">En caso de que el total no coincida con la factura "Colocar manualmente".</span>
    </div>
    {{$invoiceheaders->id}}
    {{ Form::hidden('id_user', Auth::user()->id, ['v-model' => 'id_user']) }}
    {{ Form::hidden('update_user', Auth::user()->id, ['v-model' => 'update_user']) }}
    {{ Form::hidden('id_load', $load->id, ['v-model' => 'id_load']) }}
    {{ Form::hidden('id_invoiceh', $invoiceheaders->id, ['v-model' => 'id_invoiceh']) }}
</div>