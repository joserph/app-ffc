{{ $load }}

{{ $logistics }}

{{ $company }}

<div class="row">
    <div class="col-md-6 form-group">
        {{ Form::label('id_company', 'Mi Empresa', ['class' => 'control-label']) }}
        <input type="text" name="id_company" class="form-control @error('id_company') is-invalid @enderror" wire:model="id_company">
    </div>
    <div class="col-md-6 form-group">
        {{ Form::label('invoice', 'N° de factura', ['class' => 'control-label']) }}
        <input type="text" name="invoice" class="form-control @error('invoice') is-invalid @enderror" wire:model="invoice">
    </div>

</div>