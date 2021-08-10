<div class="row">
    <div class="col-md-6 form-group">
        {{ Form::label('name', 'Nombre del cliente', ['class' => 'control-label']) }}
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" wire:model="name">
    </div>
    <div class="col-md-3 form-group">
        {{ Form::label('phone', 'Teléfono', ['class' => 'control-label']) }}
        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" wire:model="phone">
    </div>
    <div class="col-md-3 form-group">
        {{ Form::label('email', 'Correo', ['class' => 'control-label']) }}
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" wire:model="email">
    </div>
    <div class="col-md-6 form-group">
        {{ Form::label('address', 'Dirección', ['class' => 'control-label']) }}
        <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" wire:model="address">
    </div>
    <div class="col-md-2 form-group">
        {{ Form::label('state', 'Estado', ['class' => 'control-label']) }}
        <input type="text" name="state" class="form-control @error('state') is-invalid @enderror" wire:model="state">
    </div>
    <div class="col-md-2 form-group">
        {{ Form::label('city', 'Ciudad', ['class' => 'control-label']) }}
        <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" wire:model="city">
    </div>
    <div class="col-md-2 form-group">
        {{ Form::label('country', 'País', ['class' => 'control-label']) }}
        <input type="text" name="country" class="form-control @error('country') is-invalid @enderror" wire:model="country">
    </div>
    <div class="col-md-12 form-group">
        {{ Form::label('poa', 'POA', ['class' => 'control-label']) }}
    </div>
    <div class="col-md-2 form-group">
        <div class="form-check form-check-inline">
            <input class="form-check-input @error('poa') is-invalid @enderror" type="radio" name="poa" id="yes" wire:model="poa" value="yes">
            <label class="form-check-label" for="yes">Si</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input @error('poa') is-invalid @enderror" type="radio" name="poa" id="no" wire:model="poa" value="no">
            <label class="form-check-label" for="no">No</label>
        </div>
    </div>
    <div class="col-md-2 form-group">
        {{ Form::label('color', 'Color', ['class' => 'control-label']) }}
        <input type="color" name="color" class="form-control @error('color') is-invalid @enderror" wire:model="color">
    </div>
</div>
