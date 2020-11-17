<div class="row">
   <div class="col-md-4 form-group">
      {{ Form::label('', 'N° Carga', ['class' => 'control-label']) }}
      <input type="text" class="form-control" value="{{ $shipment }}" readonly>
      <input type="hidden" name="id_load" class="form-control" wire:model="id_load">
   </div>
   <div class="col-md-4 form-group">
      {{ Form::label('', 'BL', ['class' => 'control-label']) }}
      <input type="text" class="form-control" value="{{ $bl }}" readonly>
      <input type="hidden" name="bl" class="form-control" wire:model="bl">
   </div>
   <div class="col-md-4 form-group">
      {{ Form::label('', 'Mi Empresa', ['class' => 'control-label']) }}
      <input type="text" name="" class="form-control" value="{{ $company[0]->name }}" readonly>
      <input type="hidden" class="form-control" wire:model="id_company">
   </div>
   <div class="col-md-4 form-group">
      {{ Form::label('id_logistics_company', 'Empresa de Logística', ['class' => 'control-label']) }}
      {{ Form::select('id_logistics_company', $logistics, null, ['class' => 'form-control', 'wire:model' => 'id_logistics_company', 'placeholder' => 'Seleccione Empresa de Logística']) }}
   </div>
   <div class="col-md-4 form-group">
      {{ Form::label('invoice', 'N° de Factura', ['class' => 'control-label']) }}
      <input type="text" name="invoice" class="form-control @error('invoice') is-invalid @enderror" wire:model="invoice">
   </div>
   <div class="col-md-4 form-group">
      {{ Form::label('date', 'Fecha', ['class' => 'control-label']) }}
      <input type="date" name="date" class="form-control @error('date') is-invalid @enderror" wire:model="date">
   </div>
</div>