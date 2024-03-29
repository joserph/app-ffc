<div class="row">
    <div class="col-md-4 form-group">
        {{ Form::label('id_farm', 'Finca', ['class' => 'control-label']) }}
        {{ Form::select('id_farm', $farms, null, ['class' => 'form-control select-farm', 'placeholder' => 'Seleccione finca', 'v-model' => 'fillInvoiceItem.id_farm']) }}
        <span class="text-danger" v-for="error in errors" v-if="error.id_farm">El campo Finca es obligatorio.</span>
        <span class="text-danger" v-for="error in errors" v-if="error.fa_cl_de">La conbinación de Finca, Cliente y Variedad esta duplicada.</span>
    </div>
    <div class="col-md-4 form-group">
        {{ Form::label('id_client', 'Cliente', ['class' => 'control-label']) }}
        {{ Form::select('id_client', $clients, null, ['class' => 'form-control select-client', 'placeholder' => 'Seleccione cliente', 'v-model' => 'fillInvoiceItem.id_client']) }}
        <span class="text-danger" v-for="error in errors" v-if="error.id_client">El campo Cliente es obligatorio.</span>
        <span class="text-danger" v-for="error in errors" v-if="error.fa_cl_de">La conbinación de Finca, Cliente y Variedad esta duplicada.</span>
    </div>
    <div class="col-md-4 form-group">
        {{ Form::label('variety_id', 'Variedad', ['class' => 'control-label']) }}
        {{ Form::select('variety_id', $varieties, null, ['class' => 'form-control select-product', 'placeholder' => 'Seleccione tipo', 'v-model' => 'fillInvoiceItem.variety_id']) }}
        <span class="text-danger" v-for="error in errors" v-if="error.variety_id">El campo Variedad es obligatorio.</span>
        <span class="text-danger" v-for="error in errors" v-if="error.fa_cl_de">La conbinación de Finca, Cliente y Variedad esta duplicada.</span>
    </div>
    <div class="col-sm-2">
        {{ Form::label('hb', 'HB', ['class' => 'control-label']) }}
        {{ Form::number('hb', null, ['class' => 'form-control', 'v-model' => 'fillInvoiceItem.hb']) }}
    </div>
    <div class="col-sm-2">
        {{ Form::label('qb', 'QB', ['class' => 'control-label']) }}
        {{ Form::number('qb', null, ['class' => 'form-control', 'v-model' => 'fillInvoiceItem.qb']) }}
    </div>
    <div class="col-sm-2">
        {{ Form::label('eb', 'EB', ['class' => 'control-label']) }}
        {{ Form::number('eb', null, ['class' => 'form-control', 'v-model' => 'fillInvoiceItem.eb']) }}
    </div>
    <div class="col-sm-3">
        {{ Form::label('hawb', 'HAWB', ['class' => 'control-label']) }}
        {{ Form::text('hawb', null, ['class' => 'form-control', 'v-model' => 'fillInvoiceItem.hawb']) }}
        <span class="text-danger" v-for="error in errors">@{{ error.hawb }}</span>
    </div>
    <div class="col-sm-3">
        {{ Form::label('stems_p_bunches', 'Tallos por bonches', ['class' => 'control-label']) }}
        {{ Form::select('stems_p_bunches', [
            '1' => '1',
            '5' => '5',
            '6' => '6',
            '8' => '8',
            '10' => '10',
            '12' => '12',
            '25' => '25',
            ], '25', ['class' => 'form-control grupo', 'id' => 'Editstems_p_bunches', 'v-model' => 'fillInvoiceItem.stems_p_bunches']) }}
            <span class="text-danger" v-for="error in errors" v-if="error.stems_p_bunches">El campo Tallos por bunche es obligatorio.</span>
    </div>
    <div class="col-sm-3">
        {{ Form::label('stems', 'Tallos', ['class' => 'control-label']) }}
        {{ Form::number('stems', null, ['class' => 'form-control grupo', 'id' => 'Editstems', 'v-model' => 'fillInvoiceItem.stems']) }}
        <span class="text-danger" v-for="error in errors" v-if="error.stems">El campo Tallos es obligatorio.</span>
    </div>
    <div class="col-sm-3">
        {{ Form::label('bunches', 'Ramos', ['class' => 'control-label']) }}
        {{ Form::number('bunches', null, ['class' => 'form-control', 'id' => 'Editbunches', 'v-model' => 'fillInvoiceItem.bunches', 'readonly']) }}
        <span class="text-danger" v-for="error in errors" v-if="error.bunches">El campo Ramos es obligatorio.</span>
    </div>
    <div class="col-sm-3">
        {{ Form::label('price', 'Precio', ['class' => 'control-label']) }}
        {{ Form::text('price', null, ['class' => 'form-control grupo', 'id' => 'Editprice', 'v-model' => 'fillInvoiceItem.price']) }}
        <span class="text-danger" v-for="error in errors" v-if="error.price">El campo Precio es obligatorio.</span>
    </div>
    <div class="col-sm-3">
        {{ Form::label('total', 'Total', ['class' => 'control-label']) }}
        {{ Form::text('total', null, ['class' => 'form-control', 'id' => 'Edittotal', 'v-model' => 'fillInvoiceItem.total', 'readonly']) }}
        <span class="text-danger" v-for="error in errors" v-if="error.total">El campo Total es obligatorio.</span>
    </div>
    <div class="form-group col-md-12">
        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
          <input type="checkbox" class="custom-control-input" id="EditcustomSwitch3">
          <label class="custom-control-label" for="customSwitch3">Agregar cliente para confirmación</label>
        </div>
    </div>
    <div class="col-md-4 form-group client_confirm">
        {{ Form::label('client_confim_id', 'Cliente para Confirmación', ['class' => 'control-label']) }}
        {{ Form::select('client_confim_id', $clients, null, ['class' => 'form-control select-client', 'placeholder' => 'Seleccione cliente', 'v-model' => 'fillInvoiceItem.client_confim_id']) }}
        <span class="text-danger" v-for="error in errors" v-if="error.client_confim_id">El campo Cliente es obligatorio.</span>
    </div>
    {{ Form::hidden('update_user', Auth::user()->id, ['id' => 'Editupdate_user']) }}
    {{ Form::hidden('id_load', $load->id, ['id' => 'Editid_load']) }}
    {{ Form::hidden('id_invoiceh', $invoiceheaders->id, ['id' => 'Editid_invoiceh']) }}
</div>