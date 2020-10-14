<div>
    <div class="container-fluid">
        <ul class="full-box list-unstyled page-nav-tabs">
            <li>
            <a href="{{route('listPrices.create')}}"><i class="fas fa-plus fa-fw"></i> &nbsp; AJOUTER UNE LISTE DE PRIX</a>
            </li>
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
                        <th>Liste de prix</th>
                        <th>Remise</th>
                        <th>Devise</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($listPrices)==0)
                    <tr>
                        <td colspan="5">Pas de liste disponnible</td>
                        </tr>
                    @else
                    @foreach ($listPrices as $listPrice)
                    <tr class="text-center">
                        <td onclick="document.location='/listPrices/{{$listPrice['id']}}'">{{ $listPrice['name'] }}</td>
                        <td onclick="document.location='/listPrices/{{$listPrice['id']}}'">{{ $listPrice['remise'] ."%" }}</td>
                        @foreach($currencies as $currency)
                        @if($listPrice['currency_id'] == $currency->id)
                        <td onclick="document.location='/listPrices/{{$listPrice['id']}}'">{{ $currency->name }}</td>
                        @endif
                        @endforeach
                                    <td>
                                        <a href="/listPrices/{{ $listPrice['id'] }}/edit" class="btn btn-success">
                                            <i class="fas fa-sync-alt"></i>
                                        </a>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$listPrice['id']}}">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade bd-example-modal-sm" id="exampleModal{{$listPrice['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModal{{$listPrice['id']}}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h2 class="swal2-title" id="swal2-title" style="display: flex;">Liste de prix : {{$listPrice['name'] ?? ''}}</h2>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @if ( count($listPrice->orders)>0)
                                                    Cette liste est déja utilisée, vous ne pouvez pas la supprimer!
                                                    @else
                                                    Voulez-vous vraiment supprimer cette liste de prix?
                                                    @endif

                                                </div>

                                                <div class="modal-footer">
                                                    @if (count($listPrice->orders)>0)
                                                    <form>
                                                        <button class="swal2-confirm swal2-styled"
                                                        style="display: inline-block; background-color: rgb(48, 133, 214); border-left-color: rgb(48, 133, 214); border-right-color: rgb(48, 133, 214);"
                                                        type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Fermer</button>
                                                        </form>
                                                    @else
                                                    <form action="/listPrices/{{ $listPrice['id'] ?? ''}}" method='post'>
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
        {{ $listPrices->links() }}
    </div>
</div>

@section('jsnagh')
@foreach($listPrices as $listPrice)
<script>
$("#exampleModal{{$listPrice['id']}}").on('shown.bs.modal', function () {
  $("#myInput{{$listPrice['id']}}").trigger('focus')
})
</script>
@endforeach
@endsection
