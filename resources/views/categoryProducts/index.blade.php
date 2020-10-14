@extends('layouts.base')
@section('sidebar')
    @include('_partials._sidebar_accueil')
@endsection

@section('you')

    <main class="full-box main-container">
        <section class="full-box page-content">
            @include('_partials._navbar')
            <!-- Page header -->
            <div class="full-box page-header">
                <h3 class="text-left">
                    <i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTE DES CATÉGORIES
                </h3>
                @include('categoryProducts.breadcumb')
            </div>
            <div class="container-fluid">
                <ul class="full-box list-unstyled page-nav-tabs">
                    <li>
                        <a href="{{ route('categoryProducts.create') }}"><i class="fas fa-plus fa-fw"></i> &nbsp; AJOUTER UNE CATÉGORIE</a>
                    </li>
                    <li>
                        <a class="active" href="{{ route('categoryProducts.index') }}"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTE DES CATÉGORIES</a>
                    </li>
                </ul>
            </div>

            <!--CONTENT-->
           <div class="container-fluid">
				<div class="table-responsive">
					<table class="table table-dark table-sm">
						<thead>
							<tr class="text-center roboto-medium">
                                <th>Nom</th>
                                <th>Modifier</th>
                                <th>Supprimer</th>
							</tr>
						</thead>
						<tbody>
                            @forelse($categoryProducts as $categoryProduct)
                                <tr class="text-center">
                                <td onclick="document.location='/categoryProducts/{{$categoryProduct->id}}'">{{ $categoryProduct->name }}</td>
                                                <td>
                                                    <a href="{{ route('categoryProducts.edit',["categoryProduct"=>$categoryProduct->id]) }}" class="btn btn-success">
                                                        <i class="fas fa-sync-alt"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$categoryProduct['id']}}">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                    <!-- Modal -->
                                                    <div class="modal fade bd-example-modal-sm" id="exampleModal{{$categoryProduct['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModal{{$categoryProduct['id']}}" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h2 class="swal2-title" id="swal2-title" style="display: flex;">Catégorie produit : {{$categoryProduct['name'] ?? ''}}</h2>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @if (count($categoryProduct->products)>0)
                                                                Cette catégorie d'articles est déja utilisé, vous ne pouvez pas la supprimer !
                                                            @else
                                                            Voulez-vous vraiment supprimer cette catégorie de produit?
                                                            @endif

                                                        </div>

                                                        <div class="modal-footer">
                                                            @if (count($categoryProduct->products)>0)
                                                            <form>
                                                                <button class="swal2-confirm swal2-styled"
                                                                style="display: inline-block; background-color: rgb(48, 133, 214); border-left-color: rgb(48, 133, 214); border-right-color: rgb(48, 133, 214);"
                                                                type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Fermer</button>
                                                                </form>
                                                            @else
                                                            <form action="/categoryProducts/{{ $categoryProduct['id'] ?? ''}}" method='post'>
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
                            @empty
                                <tr>
                                <td colspan="4">Pas de catégorie.</td>
                                </tr>
                            @endforelse
						</tbody>
					</table>
				</div>
			</div>
        </section>
    </main>
@endsection


@section('jsnagh')
@foreach($categoryProducts as $categoryProduct)
<script>
$("#exampleModal{{$categoryProduct['id']}}").on('shown.bs.modal', function () {
  $("#myInput{{$categoryProduct['id']}}").trigger('focus')
})
</script>
@endforeach
@endsection
