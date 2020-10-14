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
                    <i class="fas fa-plus fa-fw"></i> &nbsp; AJOUTER UNE LISTE
                </h3>
                @include('listPrices.breadcumb')
            </div>
            <div class="container-fluid">
                <ul class="full-box list-unstyled page-nav-tabs">
                    <li>
                        <a class="active" href="{{route('listPrices.create')}}"><i class="fas fa-plus fa-fw"></i> &nbsp; AJOUTER UNE LISTE DE PRIX</a>
                    </li>
                    <li>
                        <a href="{{route('listPrices.index')}}"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTES DE PRIX</a>
                    </li>
                </ul>
            </div>

            <!--CONTENT-->
            <div class="container-fluid">
                <form action="{{route('listPrices.store')}}" class="form-neon" autocomplete="off" method='post'>
                    @csrf
					<fieldset>
						<legend><i class="far fa-plus-square"></i> &nbsp; Informations sur la liste</legend>
						<div class="container-fluid">
                            <div class="form-row">
                                <div class="md-form col-md-6 mt-4">
                                    <label for="inputName">Nom</label>
                                    <input type="text" class="form-control" name="inputName"  placeholder="Nom de la liste" value="{{ old('inputName') }}" autofocus>
                                    @error('inputName')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="md-form col-md-6 mt-4">
                                <label for="inputType">Remise </label>
                                <input type="text" class="form-control" name="inputRemise" placeholder="Remise appliquée sur cette liste" value="{{ old('inputRemise') }}">
                                    @error('inputRemise')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12 mt-4">
                                <label for="inputCurrencyID">Devise</label>
                                <select name="inputCurrencyID" class="form-control js-example-basic-multiple">
                                   <option value="" selected="" disabled="">Selectionner une devise</option>
                                    @forelse($currencies as $currency)
                                        <option value="{{ $currency->id }}" {{ old('inputCurrencyID') == $currency->id ? 'selected' : '' }}>{{ $currency->name }}</option>
                                    @empty
                                        <option value=''>Aucune devise </option>
                                    @endforelse
                                </select>
                                @error('inputCurrencyID')
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
    var lien=<?php  echo json_encode("Nouveau"); ?>;
    var url="/listPrices/create";
    $('.breadcrumb-item').removeClass('active');
    $('.breadcrumb').append('<a class="breadcrumb-item active" href='+url+' >'+lien+'</a>');

    });
    </script>
@endsection
