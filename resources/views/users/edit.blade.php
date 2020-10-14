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
                    <i class="fas fa-sync-alt"></i> &nbsp; MODIFIER UN UTILISATEUR
                </h3>
                @include('users.breadcumb')
            </div>
            <div class="container-fluid">
                <ul class="full-box list-unstyled page-nav-tabs">
                    <li>
                        <a href="{{ route('users.create') }}"><i class="fas fa-plus fa-fw"></i> &nbsp; AJOUTER UN UTILISATEUR</a>
                    </li>
                    <li>
                        <a href="{{ route('users.index') }}"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTE DES UTILISATEURS</a>
                    </li>
                </ul>
            </div>

            <!--CONTENT-->
            <div class="container-fluid">
                <form action="/users/{{ $user->id }}" class="form-neon" autocomplete="off" method='post'>
                    @csrf
                    @method('PATCH')
					<fieldset>
						<legend><i class="far fa-address-card"></i> &nbsp; Informations sur l'utilisateur </legend>
						<div class="container-fluid">
                            <div class="form-row">
                                <div class="md-form  col-md-6 mt-4">
                                <label for="inputName">Nom</label>
                                <input type="text" class="form-control" name="inputName" placeholder="Nom de la user" value="{{ $user->name }}">
                                @error('inputName')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>

                                <div class="md-form  col-md-6 mt-4">
                                <label for="inputRole">Rôle</label>
                                    <select name="inputRole" class="form-control js-example-basic-multiple">
                                        <option value="" selected="" disabled="">Selectionner un rôle</option>
                                        <option value='Magasinier' {{ $user->role == 'Magasinier' ? 'selected' : '' }}>Magasinier</option>
                                        <option value='Financier'{{ $user->role == 'Financier' ? 'selected' : '' }}>Financier</option>

                                    </select>
                                    @error('inputRole')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror


                                </div>
                            </div>
						</div>
					</fieldset>
					<p class="text-center" style="margin-top: 40px;">
						<button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; ENREGISTRER</button>
					</p>
				</form>
			</div>
        </section>
</main>
@endsection

@section('jsnagh')
<script>$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
        var id=<?php  echo json_encode($user->id); ?>;
        var lien=<?php  echo json_encode('Modification '.$user->name); ?>;
        var url="/users/"+id+"/edit";
        $('.breadcrumb-item').removeClass('active');
        $('.breadcrumb').append('<a class="breadcrumb-item active" href='+url+' >'+lien+'</a>');

        });</script>
@endsection
