<div>
    <div class="container-fluid">
        <ul class="full-box list-unstyled page-nav-tabs">
            <li>
                <a href="{{ route('unityProducts.create') }}"><i class="fas fa-plus fa-fw"></i> &nbsp; AJOUTER UNE UNITE</a>
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

                        <th>Nom de l'unité</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($unityProducts)==0)
                    <tr>
                        <td colspan="3">Pas d'unité.</td>
                        </tr>
                    @else
                    @foreach($unityProducts as $unityProduct)
                    <tr class="text-center">

                     <td onclick="document.location='/unityProducts/{{$unityProduct['id']}}'">{{ $unityProduct['name'] }}</td>
                                   <td>
                                       <a href="{{ route('unityProducts.edit',["unityProduct"=>$unityProduct['id']]) }}" class="btn btn-success">
                                           <i class="fas fa-sync-alt"></i>
                                       </a>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$unityProduct['id']}}">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade bd-example-modal-sm" id="exampleModal{{$unityProduct['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModal{{$unityProduct['id']}}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h2 class="swal2-title" id="swal2-title" style="display: flex;">Unité de produit : {{$unityProduct['name'] ?? ''}}</h2>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                @if (count($unityProduct->products)>0)
                                                Cette unité est déja utilisée, vous ne pouvez pas la supprimer!
                                                @else
                                                Voulez-vous vraiment supprimer cette unité de produit?
                                                @endif

                                            </div>
                                            <div class="modal-footer">
                                                @if (count($unityProduct->products)>0)
                                                <form>
                                                    <button class="swal2-confirm swal2-styled"
                                                    style="display: inline-block; background-color: rgb(48, 133, 214); border-left-color: rgb(48, 133, 214); border-right-color: rgb(48, 133, 214);"
                                                    type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Fermer</button>
                                                    </form>
                                                @else
                                                <form action="/unityProducts/{{ $unityProduct['id'] ?? ''}}" method='post'>
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
        {{ $unityProducts->links() }}
    </div>
</div>

@section('jsnagh')
@foreach($unityProducts as $unityProduct)
<script>
$("#exampleModal{{$unityProduct['id']}}").on('shown.bs.modal', function () {
  $("#myInput{{$unityProduct['id']}}").trigger('focus')
})
</script>
@endforeach
@endsection
