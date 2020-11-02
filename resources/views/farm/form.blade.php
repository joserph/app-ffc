
<div class="row">
    <div class="col-md-8 form-group">
        {{ Form::label('name', 'Nombre de la finca', ['class' => 'control-label']) }}
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" wire:model="name">
        @error('name')
            <span class="text-danger">{{ $message}}</span>
        @enderror
    </div>
    <div class="col-md-4 form-group">
        {{ Form::label('phone', 'Teléfono', ['class' => 'control-label']) }}
        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" wire:model="phone">
        @error('phone')
            <span class="text-danger">{{ $message}}</span>
        @enderror
    </div>
    <div class="col-md-6 form-group">
        {{ Form::label('address', 'Dirección', ['class' => 'control-label']) }}
        <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" wire:model="address">
        @error('address')
            <span class="text-danger">{{ $message}}</span>
        @enderror
    </div>
    <div class="col-md-2 form-group">
        {{ Form::label('state', 'Estado', ['class' => 'control-label']) }}
        <input type="text" name="state" class="form-control @error('state') is-invalid @enderror" wire:model="state">
        @error('state')
            <span class="text-danger">{{ $message}}</span>
        @enderror
    </div>
    <div class="col-md-2 form-group">
        {{ Form::label('city', 'Ciudad', ['class' => 'control-label']) }}
        <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" wire:model="city">
        @error('city')
            <span class="text-danger">{{ $message}}</span>
        @enderror
    </div>
    <div class="col-md-2 form-group">
        {{ Form::label('country', 'País', ['class' => 'control-label']) }}
        <input type="text" name="country" class="form-control @error('country') is-invalid @enderror" wire:model="country">
        @error('country')
            <span class="text-danger">{{ $message}}</span>
        @enderror
    </div>
    
</div>
