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
                    <i class="fas fa-plus fa-fw"></i> &nbsp; AJOUTER UN UTILISATEUR
                </h3>
                @include('users.breadcumb')
            </div>
            <div class="container-fluid">
                <ul class="full-box list-unstyled page-nav-tabs">
                    <li>
                        <a class="active" href="#"><i class="fas fa-plus fa-fw"></i> &nbsp; AJOUTER UN UTILISATEUR</a>
                    </li>
                    <li>
                        <a href="{{ route('users.index') }}"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTE DES UTILISATEURS</a>
                    </li>
                </ul>
            </div>
      <div class="container-fluid">
				<form action="{{ route('users.store') }}" method='post' class="form-neon" autocomplete="off">
					<fieldset>
						<legend><i class="far fa-plus-square"></i> &nbsp; Information sur l'utilisateur</legend>
						<div class="container-fluid">
                                @csrf
                                <div class="form-row">
                                    <div class="md-form col-md-4 mt-4">
                                    <label for="inputName">Nom</label>
                                    <input type="text" class="form-control" name="inputName" placeholder="Nom de l'utilisateur" value="{{ old('inputName') }}" autofocus>
                                    @error('inputName')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    </div>
                                    <div class="md-form  col-md-4 mt-4">
                                    <label for="inputEmail">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Entrée une adresse email " value="{{ old('email') }}">
                                    @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                    <label for="inputRole">Rôle</label>
                                    <select name="inputRole" class="form-control js-example-basic-multiple">
                                        <option value="" selected="" disabled="">Selectionner un rôle</option>
                                        <option value='Magasinier' {{ old('inputRole') == 'Magasinier' ? 'selected' : '' }}>Magasinier</option>
                                        <option value='Financier'{{ old('inputRole') == 'Financier' ? 'selected' : '' }}>Financier</option>
                                        
                                    </select>
                                    @error('inputRole')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    </div>

                                </div>
                       </div
                    </fieldset>
                    <br>
                    <fieldset>
                            <legend><i class="fas fa-lock"></i> &nbsp; Mot de passe </legend>
                            <div class="container-fluid">
                                <div class="form-row">
                                    <div class="md-form col-md-4 mt-4">
                                    <label for="password">Mot de passe</label>
                                    <input type="password" class="form-control" name="password" placeholder="Entrer un mot de passe" value="{{ old('password') }}">
                                    @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    </div>
                                    <div class="md-form  col-md-4 mt-4">
                                    <label for="password_confirmation">Confirmer mot de passe</label>
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirmer le mot de passe " value="{{ old('password_confirmation') }}">
                                        @error('password_confirmation')
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
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endsection
