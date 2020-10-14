<div>
    <div class="container-fluid">
        <ul class="full-box list-unstyled page-nav-tabs">


        <li>

                <div class="input-group">
                <input type="text" wire:model="name" class="form-control"  placeholder="Recherche" value="{{ $name}}">
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="submit">
                    <i class="fa fa-search"></i>
                    </button>
                </div>
                </div>

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
                        <tr class="text-center roboto-medium" >

                            <th>Réception</th>
                            <th>Fournisseur</th>
                            <th>Date prévue de réception</th>
                            <th>Origine</th>
                            <th>État</th>
                            <th>Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($receptions)==0)
                            <tr>
                            <td colspan="6">Pas de réceptions</td>
                            </tr>
                        @else
                        @foreach($receptions as $reception)
                        <tr class="text-center"   @if ($reception->state=="Livré")
                            style="color:blue"
                        @endif>

                        <td onclick="document.location='retour/{{$reception->id}}'">{{ $reception->name }}</td>
                        <td onclick="document.location='retour/{{$reception->id}}'">@foreach ($tiers as $tier)
                                @if ($tier->id==$reception->tier_id)
                                    {{ $tier->name}}
                                @endif
                        @endforeach</td>
                        <td onclick="document.location='retour/{{$reception->id}}'">{{ $reception->date_shippement }}</td>
                        <td onclick="document.location='retour/{{$reception->id}}'">{{ $reception->purchase_order->name }}</td>
                        <td onclick="document.location='retour/{{$reception->id}}'">@if ($reception->state=="assigned")
                            {{ 'Prêt à livrer' }}
                        @else
                            {{ $reception->state }}
                        @endif</td>
                        <td>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$reception['id']}}">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade bd-example-modal-sm" id="exampleModal{{$reception['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModal{{$reception['id']}}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h2 class="swal2-title" id="swal2-title" style="display: flex;">Réception : {{$reception['name'] ?? ''}}</h2>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                @if ($reception->state=="Livré")
                                                    vous ne pouvez pas supprimer une livraison ayant été déja livrée!
                                                @else
                                                Voulez-vous vraiment supprimer cette livraison?
                                                @endif

                                            </div>
                                            <div class="modal-footer">
                                                @if ($reception->state=="Livré")
                                                <button class="swal2-confirm swal2-styled"
                                                style="display: inline-block; background-color: rgb(48, 133, 214); border-left-color: rgb(48, 133, 214); border-right-color: rgb(48, 133, 214);"
                                                type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Annuler</button>
                                                @else
                                                <form action="/retour/{{ $reception['id'] ?? ''}}" method='post'>
                                                    @method('delete')
                                                    @csrf
                                                    <button class="swal2-cancel swal2-styled" aria-label style="display: inline-block; background-color: rgb(221, 51, 51);"
                                                    type="submit" class="btn btn-warning">
                                                            Supprimer
                                                    </button>
                                                </form>
                                                <button class="swal2-confirm swal2-styled"
                                                style="display: inline-block; background-color: rgb(48, 133, 214); border-left-color: rgb(48, 133, 214); border-right-color: rgb(48, 133, 214);"
                                                type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Annuler</button>
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
            {{ $receptions->links() }}
        </div>
</div>
