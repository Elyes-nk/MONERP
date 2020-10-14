<div>
    <div class="container-fluid">
        <ul class="full-box list-unstyled page-nav-tabs">
            <li>
                <a href="{{ route('devis.create')}}"><i class="fas fa-plus fa-fw"></i> &nbsp; AJOUTER UN DEVIS</a>
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
            <!--CONTENT-->
</div>


<div class="container-fluid" >
            <div class="table-responsive">
                <div class="d-flex justify-content-center" >
                    <div class="spinner-border" wire:loading >
                      <span class="sr-only" >Loading...</span>
                    </div>
                  </div>
                <table class="table table-dark table-sm" wire:loading.remove>
                    <thead>
                        <tr class="text-center roboto-medium">

                            <th>Commandes</th>
                            <th>Fournisseur</th>
                            <th>Date commande</th>
                            <th>Date prévue</th>
                            <th>Total sans taxe</th>
                            <th>Taxe</th>
                            <th>Total</th>
                            <th>Modifier</th>
                            <th>Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($commandes)==0)
                            <tr>
                            <td colspan="9">Pas de commandes.</td>
                            </tr>
                        @else
                            @foreach($commandes as $commande)
                            <tr class="text-center" >

                            <td>{{ $commande->name }}</td>
                            <td>
                                @foreach ($tiers as $tier)
                                        @if ($tier->id==$commande->tier_id)
                                            {{ $tier->name}}
                                        @endif
                                @endforeach
                            </td>
                            <td>{{ $commande->date }}</td>
                            <td>{{ $commande->date_shippement }}</td>
                            <td>{{ $commande->ammount_ht }}</td>
                            <td>{{ $commande->ammount_tax }}</td>
                            <td>{{ $commande->ammount_total }}</td>
                            <td>
                                            <a href="/commandes/{{ $commande->id }}/edit" class="btn btn-success">
                                                <i class="fas fa-sync-alt"></i>
                                            </a>
                            </td>
                            <td>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$commande['id']}}">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade bd-example-modal-sm" id="exampleModal{{$commande['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModal{{$commande['id']}}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h2 class="swal2-title" id="swal2-title" style="display: flex;">Commande : {{$commande['name'] ?? ''}}</h2>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Voulez-vous vraiment supprimer cette commande?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="/commandes/{{ $commande['id'] ?? ''}}" method='post'>
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
      </li>
    </ul>
</div>

@section('jsnagh')
@foreach($commandes as $commande)
<script>
$("#exampleModal{{$commande['id']}}").on('shown.bs.modal', function () {
  $("#myInput{{$commande['id']}}").trigger('focus')
})
</script>
@endforeach
@endsection
