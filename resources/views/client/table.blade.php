@can('haveaccess', 'client.index')
<h2>Listado de Clientes</h2>
<div class="table-responsive">
   <table class="table table-sm table-hover">
    <thead>
       <tr>
          <th scope="col">Nombre</th>
          <th scope="col">Teléfono</th>
          <th scope="col">Correo</th>
          <th scope="col">Dirección</th>
          <th scope="col">Estado</th>
          <th scope="col">Ciudad</th>
          <th scope="col">País</th>
          <th scope="col">POA</th>
          <th scope="col">Color</th>
          <th class="text-center" colspan="2">@can('haveaccess', 'client.edit') Editar @endcan  @can('haveaccess', 'client.destroy')/ Eliminar @endcan</th>
       </tr>
    </thead>
    <tbody>
       @foreach ($clients as $client)
         <tr>
            <td>{{ $client->name }}</td>
            <td>{{ $client->phone }}</td>
            <td>{{ $client->email }}</td>
            <td>{{ $client->address }}</td>
            <td>{{ $client->state }}</td>
            <td>{{ $client->city }}</td>
            <td>{{ $client->country }}</td>
            <td>{{ $client->poa }}</td>
            <td>
               @foreach ($colors as $item)
                  @if ($client->id == $item->id_type)
                     @if ($item->label == 'square')
                        <span style="color: {{ $item->color }};" data-toggle="tooltip" data-placement="top" title="Etiqueta Cuadrada">
                           <i class="fas fa-square fa-2x"></i>
                        </span>
                     @else 
                        <span style="color: {{ $item->color }};" data-toggle="tooltip" data-placement="top" title="Etiqueta Punto">
                           <i class="fas fa-circle fa-2x"></i>
                        </span>
                     @endif
                  @endif
               @endforeach
            </td>
            <td colspan="2" class="text-center">
               @can('haveaccess', 'client.edit')
               <button wire:click="edit({{ $client->id }})" class="btn btn-sm btn-outline-warning">
                  <i class="far fa-edit"></i>
               </button>
               @endcan
               @can('haveaccess', 'client.destroy')
               <button wire:click="destroy({{ $client->id }})" class="btn btn-sm btn-outline-danger">
                  <i class="fas fa-trash"></i>
               </button>
               @endcan
            </td>
         </tr>
       @endforeach
    </tbody>
 </table>
 {{ $clients->links() }}
</div>
@endcan