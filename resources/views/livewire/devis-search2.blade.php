<div>
    <div class="container-fluid">
        <ul class="full-box list-unstyled page-nav-tabs">
            <li>
                <a href="{{ route('devis.create')}}"><i class="fas fa-plus fa-fw"></i> &nbsp; AJOUTER UN DEVIS</a>
            </li>
            <li>
                    <div class="input-group">
                        <input type="text" wire:model="name" class="form-control"  placeholder="Recherche">
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

                        <tr class="text-center roboto-medium">
                            <th>Devis</th>
                            <th>Fournisseur</th>
                            <th>Date devis</th>
                            <th>Date prévue</th>
                            <th>Total sans taxe</th>
                            <th>Taxes</th>
                            <th>Remises</th>
                            <th>Total</th>
                            <th>Modifier</th>
                            <th>Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($devis)==0)
                            <tr>
                            <td colspan="10">Pas de devis</td>
                            </tr>
                        @else
                        @foreach($devis as $dev)
                        <tr class="text-center" class="btn btn-raised btn-info btn-sm">
                        <td onclick="document.location='devis/{{$dev->id}}'">{{ $dev->name }}</td>
                        <td onclick="document.location='devis/{{$dev->id}}'">@foreach ($tiers as $tier)
                                @if ($tier->id==$dev->tier_id)
                                    {{ $tier->name}}
                                @endif
                        @endforeach</td>
                        <td onclick="document.location='devis/{{$dev->id}}'">{{ $dev->date }}</td>
                        <td onclick="document.location='devis/{{$dev->id}}'">{{ $dev->date_shippement }}</td>
                        <td onclick="document.location='devis/{{$dev->id}}'">{{ $dev->ammount_ht }}</td>
                        <td onclick="document.location='devis/{{$dev->id}}'">{{ $dev->ammount_tax }}</td>
                        <td onclick="document.location='devis/{{$dev->id}}'">{{ $dev->remise }}</td>
                        <td onclick="document.location='devis/{{$dev->id}}'">{{ $dev->ammount_total }}</td>
                        <td>
                            <a href="/devis/{{ $dev->id }}/edit" class="btn btn-success">
                                <i class="fas fa-sync-alt"></i>
                            </a>
                        </td>
                        <td>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$dev['id']}}">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                                <!-- Modal -->
                                <div class="modal fade bd-example-modal-sm" id="exampleModal{{$dev['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModal{{$dev['id']}}" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h2 class="swal2-title" id="swal2-title" style="display: flex;">Devis : {{$dev['name'] ?? ''}}</h2>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Voulez-vous vraiment supprimer ce devis?
                                    </div>
                                    <div class="modal-footer">
                                        <form action="/devis/{{ $dev['id'] ?? ''}}" method='post'>
                                            @method('delete')
                                            @csrf
                                            <button class="swal2-cancel swal2-styled" aria-label style="display: inline-block; background-color: rgb(221, 51, 51);" class="btn btn-warning">
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
        <div class="col-md-6 center mx-auto">
            {{ $devis->links() }}
        </div>

</div>
@section('jsnagh')
    <script>
            $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
            });
    </script>
@endsection
