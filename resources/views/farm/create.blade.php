<h2>Crear finca</h2>
@include('farm.form')

<button wire:click="store" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Crear Finca">
    <i class="fas fa-plus-circle"></i>
</button>
<button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
    Tooltip on top
  </button>
  <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="right" title="Tooltip on right">
    Tooltip on right
  </button>
  <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom">
    Tooltip on bottom
  </button>
  <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="left" title="Tooltip on left">
    Tooltip on left
  </button>