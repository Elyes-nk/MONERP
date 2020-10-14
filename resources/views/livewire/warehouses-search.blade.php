<div>
    <div class="container-fluid">
        <ul class="full-box list-unstyled page-nav-tabs">
            <li>
                <a href="{{ route('warehouses.create') }}"><i class="fas fa-plus fa-fw"></i> &nbsp; AJOUTER UN ENTREPÔT</a>
            </li>
            <li>
                <form  wire:submit.prevent="searchByName" >
                    <div class="input-group">
                        <input type="text" wire:model.lazy="name" class="form-control"  placeholder="Recherche">
                    <div class="input-group-append">
                        <button class="btn btn-secondary" type="submit">
                        <i class="fa fa-search"></i>
                        </button>
                    </div>
                    </div>
                </form>
            </li>
        </ul>
    </div>

    <!--CONTENT-->
   <div class="container-fluid">
        <div class="table-responsive">
            <div class="d-flex justify-content-center" >
                <div class="spinner-border" wire:loading >
                  <span class="sr-only" >Loading...</span>
                </div>
              </div>
            <table class="table table-dark table-sm" wire:loading.remove>
                <thead>
                    <tr class="text-center roboto-medium">

                        <th>Nom</th>
                        <th>Adresse</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                        @if (count($warehouses)==0)
                        <tr>
                            <td colspan="4">Pas d'entrepôt.</td>
                            </tr>
                        @else
                        @foreach($warehouses as $warehouse)
                        <tr class="text-center">

                        <td onclick="document.location='/warehouses/{{$warehouse['id']}}'">{{ $warehouse['name'] }}</td>
                        <td onclick="document.location='/warehouses/{{$warehouse['id']}}'">{{ $warehouse['adresse'] }}</td>
                                    <td>
                                        <a href="{{ route('warehouses.edit',["warehouse"=>$warehouse['id']]) }}" class="btn btn-success">
                                            <i class="fas fa-sync-alt fa-spi"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$warehouse['id']}}">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade bd-example-modal-sm" id="exampleModal{{$warehouse['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModal{{$warehouse['id']}}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h2 class="swal2-title" id="swal2-title" style="display: flex;">Entrepôt : {{$warehouse['name'] ?? ''}}</h2>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                @if (count($warehouse->moves)>0 OR count($warehouse->products)>0 OR count($warehouse->orders)>0)
                                                Vous ne pouvez pas supprimer cet entrepôt!
                                                @else
                                                Voulez-vous vraiment supprimer cette entrepôt?
                                                @endif

                                            </div>
                                            <div class="modal-footer">
                                                @if (count($warehouse->moves)>0 OR count($warehouse->products)>0 OR count($warehouse->orders)>0)
                                                <form>
                                                    <button class="swal2-confirm swal2-styled"
                                                    style="display: inline-block; background-color: rgb(48, 133, 214); border-left-color: rgb(48, 133, 214); border-right-color: rgb(48, 133, 214);"
                                                    type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Fermer</button>
                                                    </form>
                                                @else
                                                <form action="/warehouses/{{ $warehouse['id'] ?? ''}}" method='post'>
                                                    @method('delete')
                                                    @csrf
                                                    <button class="swal2-cancel swal2-styled" aria-label style="display: inline-block; background-color: rgb(221, 51, 51);"
                                                    type="submit" class="btn btn-warning">
                                                            Supprimer
                                                    </button>
                                                </form>
                                                <form>
                                                <button class="swal2-confirm swal2-styled"
                                                style="display: inline-block; background-color: rgb(48, 133, 214); border-left-color: rgb(48, 133, 214); border-right-color: rgb(48, 133, 214);"
                                                type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Annuler</button>
                                                </form>
                                                @endif

                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    </td>
                        </tr>
                        @endforeach
                     @endif
                </tbody>
            </table>
        </div>
    </div>
</div>


@section('jsnagh')
@foreach($warehouses as $warehouse)
<script>
$("#exampleModal{{$warehouse['id']}}").on('shown.bs.modal', function () {
  $("#myInput{{$warehouse['id']}}").trigger('focus')
})
</script>
@endforeach
@endsection
