<div class="row">
   <div class="col-md-2 form-group">
      {{ Form::label('', 'N° Carga', ['class' => 'control-label']) }}
      <input type="text" name="id_load" class="form-control" value="{{ $prueba->id }}" readonly>
   </div>
   <div class="col-md-3 form-group">
      {{ Form::label('bl', 'BL', ['class' => 'control-label']) }}
      <input type="text" name="bl" class="form-control" value="{{ $load->bl }}" readonly>
   </div>
   <div class="col-md-3 form-group">
      {{ Form::label('id_company', 'Mi Empresa', ['class' => 'control-label']) }}
      <input type="text" name="id_company" class="form-control" value="{{ $company[0]->name }}" readonly>
   </div>
   <div class="col-md-2 form-group">
      {{ Form::label('id_logistics_company', 'Empresa de Logística', ['class' => 'control-label']) }}
      {{ Form::select('id_logistics_company', $logistics, null, ['class' => 'form-control', 'wire:model' => 'id_logistics_company']) }}
   </div>
    <div class="col-md-2 form-group">
        {{ Form::label('invoice', 'N° de factura', ['class' => 'control-label']) }}
        <input type="text" value="" name="invoice" class="form-control @error('invoice') is-invalid @enderror" wire:model="invoice">
    </div>
    
    

</div>