<div>
    <div class="container-fluid">
        <ul class="full-box list-unstyled page-nav-tabs">
            @if (Auth::user()->role !="Magasinier")
            <li>
                <a href="{{ route('devis.create')}}"><i class="fas fa-plus fa-fw"></i> &nbsp; AJOUTER UN DEVIS</a>
            </li>
            @endif


        <li>
            <form   >
                <div class="input-group">
                    <input type="text" wire:model="name" class="form-control"  placeholder="Recherche">
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="submit">
                    <i class="fa fa-search"></i>
                    </button>
                </div>
                </div>
            </form>
        </li>
        <li>

            <div class="row">
              <div class="col-md-6">
                Afficher
            </div>
            <div class="col-md-6">
            <select id="sk" class="form-control" wire:model.lazy="pages">
                <?php
                $i=10;
                  while($i<=50){

                    ?>
                    <option value="{{$i }}">{{ $i}}</option>
               <?php
            $i=$i+10;
            }  ?>
            </select>
        </div>
        </div>
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

                            <th>Commande</th>
                            <th>Fournisseur</th>
                            <th>Date commande</th>
                            <th>Date prévue</th>
                            <th>État</th>
                            <th>Total sans taxes</th>
                            <th>Total taxes</th>
                            <th>Total remises</th>
                            <th>Total</th>
                            <th>Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($commandes)==0)
                            <tr>
                            <td colspan="10">Pas de commandes</td>
                            </tr>
                        @else
                        @foreach($commandes as $commande)
                        <tr class="text-center" @if ($commande->state=="Annulé")
                            style="color:red"
                        @endif>

                        <td onclick="document.location='commandes/{{$commande->id}}'">{{ $commande->name }}</td>
                        <td onclick="document.location='commandes/{{$commande->id}}'">
                        @foreach ($tiers as $tier)
                                @if ($tier->id==$commande->tier_id)
                                    {{ $tier->name}}
                                @endif
                        @endforeach
                        </td>
                        <td onclick="document.location='commandes/{{$commande->id}}'">{{ $commande->date }}</td>
                        <td onclick="document.location='commandes/{{$commande->id}}'">{{ $commande->date_shippement }}</td>
                        <td onclick="document.location='commandes/{{$commande->id}}'">@if ($commande->state=="confirmed")
                            {{"Confirmé"}}
                        @else
                            {{$commande->state}}
                        @endif </td>

                        <td onclick="document.location='commandes/{{$commande->id}}'">{{ $commande->ammount_ht }}</td>
                        <td onclick="document.location='commandes/{{$commande->id}}'">{{ $commande->ammount_tax }}</td>
                        <td onclick="document.location='commandes/{{$commande->id}}'">{{ $commande->remise }}</td>
                        <td onclick="document.location='commandes/{{$commande->id}}'">{{ $commande->ammount_total }}</td>
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
                                                @php
                                            $moves=0;
                                        @endphp
                                        @foreach ($commande->receptions as $reception)
                                            @php
                                                if($reception->state=="Reçu"){
                                                    $moves=1;
                                                }
                                            @endphp
                                        @endforeach

                                        @if ($moves==1)
                                            Attention! Vous avez déja effectuer des réceptions suite à cette commande.
                                            Pour pouvoir supprimer cette commande, il faut d'abord annuler ses réceptions.
                                        @else

                                        Si vous supprimez cette commande les réceptions et les factures liés à cette dernière seront automatiquement supprimés. Voulez-vous vraiment supprimer cette commande?

                                        @endif

                                            </div>
                                            <div class="modal-footer">
                                                @if ($moves==1)
                                                <button class="swal2-confirm swal2-styled"
                                                style="display: inline-block; background-color: rgb(48, 133, 214); border-left-color: rgb(48, 133, 214); border-right-color: rgb(48, 133, 214);"
                                                type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Annuler</button>
                                                @else
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
        <div class="col-md-6 center mx-auto">
            {{ $commandes->links() }}
        </div>
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
