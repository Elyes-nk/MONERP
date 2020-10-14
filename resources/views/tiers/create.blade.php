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
                    <i class="fas fa-plus fa-fw"></i> &nbsp; AJOUTER UN FOURNISSEUR
                </h3>
                @include('tiers.breadcumb')
            </div>
            <div class="container-fluid">
                <ul class="full-box list-unstyled page-nav-tabs">
                    <li>
                        <a class="active" href="#"><i class="fas fa-plus fa-fw"></i> &nbsp; AJOUTER UN FOURNISSEUR</a>
                    </li>
                    <li>
                    <a href="{{route('tiers.index')}}"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTE DES FOURNISSEURS</a>
                    </li>
                </ul>
            </div>
      <div class="container-fluid">
				<form action="{{ route('tiers.store') }}" method='post' class="form-neon" autocomplete="off">
					<fieldset>
                        <legend><i class="far fa-address-card"></i> &nbsp; Information du fournisseur</legend>
						<div class="container-fluid">
                                @csrf
                                <div class="form-row">
                                    <div class="md-form col-md-4">
                                    <label for="inputName">Nom</label>
                                    <input type="text" class="form-control" name="inputName" placeholder="Nom du fournisseur" value="{{ old('inputName') }}" autofocus>
                                    @error('inputName')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    </div>
                                    <div class="md-form  col-md-4">
                                    <label for="inputCode">Code</label>
                                    <input type="text" class="form-control" name="inputCode" placeholder="Code du fournisseur" value="{{ old('inputCode') }}">
                                        @error('inputCode')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    </div>
                                    <div class="md-form col-md-4">
                                    <label for="delai">Délai de livraison (En jours)</label>
                                    <input type="number" class="form-control" name="delai" placeholder="Délai de livraison" value="{{ old('delai') }}">
                                    @error('delai')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                </div>



                                <div class="form-row">
                                    <div class="md-form col-md-4 mt-4">
                                    <label for="inputPays">Pays</label>
                                    <input type="text" class="form-control" name="inputPays" placeholder="Pays" value="{{ old('inputCodeP') }}">
                                    @error('inputPays')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    </div>
                                    <div class="md-form col-md-4 mt-4">
                                    <label for="inputAdresse">Adresse </label>
                                    <input type="text" class="form-control" name="inputAdresse" placeholder="Adresse" value="{{ old('inputAdresse') }}">
                                    @error('inputAdresse')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    </div>
                                    <div class="md-form  col-md-4 mt-4">
                                    <label for="inputCodeP">Code postal  </label>
                                    <input type="text" class="form-control" name="inputCodeP" placeholder="Code postal" value="{{ old('inputCodeP') }}">
                                    @error('inputCodeP')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    </div>

                                </div>
                             </div>
					</fieldset>
					<br><br><br>
					<fieldset>
                    <legend><i class="far fa-plus-square"></i> &nbsp; Information supplémentaires</legend>
						<div class="container-fluid">

                                <div class="form-row">
                                    <div class="md-form col-md-4 mt-4">
                                    <label for="inputPhone">Numéro  </label>
                                    <input type="number" class="form-control" name="inputPhone" placeholder="Numéro de télephone" value="{{ old('inputPhone') }}">
                                    @error('inputPhone')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    </div>
                                    <div class="md-form col-md-4 mt-4">
                                    <label for="inputEmail" data-error="wrong" data-success="right">Email </label>
                                    <input type="email" class="form-control validate" id="inputEmail" name="inputEmail" placeholder="Email" value="{{ old('inputEmail') }}">
                                    @error('inputEmail')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    </div>
                                    <div class="md-form col-md-4 mt-4">
                                    <label for="inputWeb">Site web</label>
                                    <input type="text" class="form-control" name="inputWeb" placeholder="Site web" value="{{ old('inputWeb') }}">
                                    @error('inputWeb')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12 mt-4">
                                    <label for="inputList_prices_id">Liste de prix</label>
                                    <select name="inputList_prices_id" class="form-control js-example-basic-multiple">
                                       <option value="" selected="" disabled="">Selectionner une liste de prix</option>
                                        @forelse($list_prices as $list_price)
                                            <option value="{{ $list_price->id }}" {{ old('inputList_prices_id') == $list_price->id ? 'selected' : '' }}>{{ $list_price->name }}</option>
                                        @empty
                                            <option value=''>Aucune liste de prix </option>
                                        @endforelse
                                    </select>
                                    @error('inputList_prices_id')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
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
        var lien=<?php  echo json_encode("Nouveau"); ?>;
        var url="/tiers/create";
        $('.breadcrumb-item').removeClass('active');
        $('.breadcrumb').append('<a class="breadcrumb-item active" href='+url+' >'+lien+'</a>');

        });
        </script>
    @endsection
