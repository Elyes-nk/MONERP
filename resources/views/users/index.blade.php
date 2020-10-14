@extends('layouts.base')
@section('sidebar')
    @include('_partials._sidebar_accueil')
@endsection


@section('you')
        <main class="full-box main-container">
        <section class="full-box page-content">
        @include('_partials._navbar')
        <div class="full-box page-header">
                <h3 class="text-left">
                    <i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTE DES UTILISATEURS
                </h3>
                @include('users.breadcumb')
                
                @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}                               
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
            </div>              
                <div class="container-fluid">
                <ul class="full-box list-unstyled page-nav-tabs">
                    <li>
                        <a href="{{ route('users.create') }}"><i class="fas fa-plus fa-fw"></i> &nbsp; AJOUTER UN UTILISATEUR</a>
                    </li>
                    <li>
                        <a class="active" href="{{ route('users.index') }}"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTE DES UTILISATEURS</a>
                    </li>
                </ul>
            </div>

            <!--CONTENT-->
           <div class="container-fluid">
				<div class="table-responsive">
					<table class="table table-dark table-sm">
						<thead>
							<tr class="text-center roboto-medium">
                                <th>Nom </th>
                                <th>Email</th>
                                <th>Rôle</th>
                                <th>Modifier</th>
                                <th>Supprimer</th>
							</tr>
						</thead>
						<tbody>
                            @forelse($users as $user)
                                <tr class="text-center">
                                <td onclick="document.location='/users/{{$user->id}}'">{{ $user->name }}</td>
                                <td onclick="document.location='/users/{{$user->id}}'">{{ $user->email }}</td>
                                <td onclick="document.location='/users/{{$user->id}}'">{{ $user->role }}</td>
                                <td>
                                                <a href="/users/{{$user->id}}/edit" class="btn btn-success">
                                                    <i class="fas fa-sync-alt"></i>
                                                </a>
                                 </td>
                                <td>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$user['id']}}">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                    <!-- Modal -->
                                                    <div class="modal fade bd-example-modal-sm" id="exampleModal{{$user['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModal{{$user['id']}}" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h2 class="swal2-title" id="swal2-title" style="display: flex;">Utilisateur : {{$user['name'] ?? ''}}</h2>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Voulez-vous vraiment supprimer cette utilisateur?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="/users/{{ $user['id'] ?? ''}}" method='post'>
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
                                @empty
                                <tr>
                                <td colspan="5">Pas d'utilisateurs.</td>
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
@foreach($users as $user)
<script>
$("#exampleModal{{$user['id']}}").on('shown.bs.modal', function () {
  $("#myInput{{$user['id']}}").trigger('focus')
})
</script>
@endforeach
@endsection