<h2>Listado de Fincas</h2>
<div class="table-responsive">
<table class="table table-sm table-hover">
    <thead>
       <tr>
          <th scope="col">Nombre</th>
          <th scope="col">Telefono</th>
          <th scope="col">Dirección</th>
          <th scope="col">Estado</th>
          <th scope="col">Ciudad</th>
          <th scope="col">Pais</th>
          <th class="text-center" colspan="2">&nbsp;</th>
       </tr>
    </thead>
    <tbody>
       @foreach ($farms as $farm)
         <tr>
            <td>{{ $farm->name }}</td>
            <td>{{ $farm->phone }}</td>
            <td>{{ $farm->address }}</td>
            <td>{{ $farm->state }}</td>
            <td>{{ $farm->city }}</td>
            <td>{{ $farm->country }}</td>
            <td colspan="2">
               <button wire:click="edit({{ $farm->id }})" class="btn btn-sm btn-outline-warning">
                  <i class="far fa-edit"></i>
               </button>
               <button wire:click="destroy({{ $farm->id }})" class="btn btn-sm btn-outline-danger">
                  <i class="fas fa-trash"></i>
               </button>
            </td>
         </tr>
       @endforeach
    </tbody>
 </table>
 {{ $farms->links() }}
</div>