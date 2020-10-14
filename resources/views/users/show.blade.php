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
                    <i class="far fa-address-card"></i> &nbsp; INFORMATIONS SUR L'UTILISATEUR
                </h3>
                @include('users.breadcumb')
            </div>      
             <div class="container-fluid">
                <ul class="full-box list-unstyled page-nav-tabs">
                    <li>
                        <a href="{{ route('users.create') }}"><i class="fas fa-plus fa-fw"></i> &nbsp; AJOUTER UN UTILISATEUR</a>
                    </li>
                    <a href="{{ route('users.show',["user"=>$id_previous->id]) }}" class="btn btn-raised btn btn" ><i class="fas fa-chevron-left"></i></a>
                    <li>
                        <a href="{{ route('users.index') }}"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTE DES UTILISATEUR</a>
                    </li>
                    <a href="{{ route('users.show',["user"=>$id_next->id ]) }}" class="btn btn-raised btn btn" ><i class="fas fa-chevron-right"></i></a>                    
                </ul>
            </div>
      <div class="container-fluid">
				<form class="form-neon" autocomplete="off">
					<fieldset>
						<legend><i class="far fa-address-card"></i> &nbsp; Information sur l'utilisateur</legend>
						<div class="container-fluid">
                                <div class="form-row">
                                    <div class="md-form col-md-4 mt-4">
                                    <label for="inputName">Nom :</label>
                                    <label for="inputName"> <strong> {{$user->name}}</strong></label>
                                    </div>
                                    <div class="md-form  col-md-4 mt-4">
                                    <label for="inputType">Email :</label>
                                    <label for="inputName"> <strong> {{$user->email}}</strong></label>
                                    </div>
                                    <div class="md-form col-md-4 mt-4">
                                    <label for="inputTaux">Rôle :</label>
                                    <label for="inputName"> <strong>{{ $user->role }}</strong></label>
                                    </div>
                                </div>
                         </div>
					</fieldset>
					<p class="text-center" style="margin-top: 40px;">
                    <button  onclick="document.location='/users/{{$user->id}}/edit'" type="button" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; MODIFIER</button>
					</p>
				</form>
			</div>
        </section>
    </main>
    @endsection
    @section('jsnagh')
    <script>$(document).ready(function() {
            var id=<?php  echo json_encode($user->id); ?>;
            var lien=<?php  echo json_encode($user->name); ?>;
            var url="/users/"+id;
            $('.breadcrumb-item').removeClass('active');
            $('.breadcrumb').append('<a class="breadcrumb-item active" href='+url+' >'+lien+'</a>');

            });</script>
    @endsection

