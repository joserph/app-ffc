<div class="row">
    <div class="col-md-4 form-group">
        {{ Form::label('id_farm', 'Finca', ['class' => 'control-label']) }}
        {{ Form::select('id_farm', $farms, null, ['class' => 'form-control select-farm', 'placeholder' => 'Seleccione finca', 'v-model' => 'id_farm']) }}
        <span class="text-danger" v-for="error in errors">@{{ error.id_farm }}</span>
    </div>
    <div class="col-md-4 form-group">
        {{ Form::label('id_client', 'Cliente', ['class' => 'control-label']) }}
        {{ Form::select('id_client', $clients, null, ['class' => 'form-control select-client', 'placeholder' => 'Seleccione cliente', 'v-model' => 'id_client']) }}
        <span class="text-danger" v-for="error in errors">@{{ error.id_client }}</span>
    </div>
    <div class="col-md-4 form-group">
        {{ Form::label('variety_id', 'Descripción', ['class' => 'control-label']) }}
        {{ Form::select('variety_id', $varieties, null, ['class' => 'form-control select-product', 'placeholder' => 'Seleccione tipo', 'v-model' => 'variety_id']) }}
        <span class="text-danger" v-for="error in errors">@{{ error.variety_id }}</span>
    </div>
    <div class="col-sm-2">
        {{ Form::label('hb', 'HB', ['class' => 'control-label']) }}
        {{ Form::number('hb', null, ['class' => 'form-control', 'v-model' => 'hb']) }}
        <span class="text-danger" v-for="error in errors">@{{ error.hb }}</span>
    </div>
    <div class="col-sm-2">
        {{ Form::label('qb', 'QB', ['class' => 'control-label']) }}
        {{ Form::number('qb', null, ['class' => 'form-control', 'v-model' => 'qb']) }}
        <span class="text-danger" v-for="error in errors">@{{ error.qb }}</span>
    </div>
    <div class="col-sm-2">
        {{ Form::label('eb', 'EB', ['class' => 'control-label']) }}
        {{ Form::number('eb', null, ['class' => 'form-control', 'v-model' => 'eb']) }}
        <span class="text-danger" v-for="error in errors">@{{ error.eb }}</span>
    </div>
    <div class="col-sm-3">
        {{ Form::label('hawb', 'HAWB', ['class' => 'control-label']) }}
        {{ Form::text('hawb', null, ['class' => 'form-control', 'v-model' => 'hawb']) }}
        <span class="text-danger" v-for="error in errors">@{{ error.hawb }}</span>
    </div>
    <div class="col-sm-3">
        {{ Form::label('stems_p_bunches', 'Tallos por bonches', ['class' => 'control-label']) }}
        {{ Form::select('stems_p_bunches', [
            '10' => '10',
            '12' => '12',
            '25' => '25',
            ], '25', ['class' => 'form-control grupo', 'id' => 'stems_p_bunches', 'v-model' => 'stems_p_bunches']) }}
            <span class="text-danger" v-for="error in errors">@{{ error.stems_p_bunches }}</span>
    </div>
    <div class="col-sm-3">
        {{ Form::label('stems', 'Tallos', ['class' => 'control-label']) }}
        {{ Form::number('stems', null, ['class' => 'form-control grupo', 'id' => 'stems', 'v-model' => 'stems']) }}
        <span class="text-danger" v-for="error in errors">@{{ error.stems }}</span>
    </div>
    <div class="col-sm-3">
        {{ Form::label('bunches', 'Bonches', ['class' => 'control-label']) }}
        {{ Form::number('bunches', null, ['class' => 'form-control', 'id' => 'bunches', 'v-model' => 'bunches']) }}
        <span class="text-danger" v-for="error in errors">@{{ error.bunches }}</span>
    </div>
    <div class="col-sm-3">
        {{ Form::label('price', 'Precio', ['class' => 'control-label']) }}
        {{ Form::text('price', null, ['class' => 'form-control grupo', 'id' => 'price', 'v-model' => 'price']) }}
        <span class="text-danger" v-for="error in errors">@{{ error.price }}</span>
    </div>
    <div class="col-sm-3">
        {{ Form::label('total', 'Total', ['class' => 'control-label']) }}
        {{ Form::text('total', null, ['class' => 'form-control', 'id' => 'total', 'v-model' => 'total']) }}
        <span class="text-danger" v-for="error in errors">@{{ error.total }}</span>
    </div>
    {{ Form::hidden('id_user', Auth::user()->id, ['id' => 'id_user']) }}
    {{ Form::hidden('update_user', Auth::user()->id, ['id' => 'update_user']) }}
    {{ Form::hidden('id_load', $load->id, ['id' => 'id_load']) }}
    {{ Form::hidden('id_invoiceh', $invoiceheaders->id, ['id' => 'id_invoiceh']) }}
</div>