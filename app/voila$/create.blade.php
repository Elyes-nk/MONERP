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
                    <i class="fas fa-clipboard-list fa-fw"></i> &nbsp; AJOUTER UNE DEMANDE D'ACHAT
                </h3>
                @include('devis.breadcumb')
            </div>
            <div class="container-fluid">
                <ul class="full-box list-unstyled page-nav-tabs">
                    <li>
                        <a class="active" href="{{route('devis.create')}}"><i class="fas fa-plus fa-fw"></i> &nbsp; AJOUTER UN DEVIS</a>
                    </li>
                    <li>
                        <a href="{{route('devis.index')}}"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTE DES DEVIS</a>
                    </li>
                </ul>
            </div>

            <!--CONTENT-->
            <div class="container-fluid">
                <form action="{{route('devis.store')}}" class="form-neon" autocomplete="off" method='post'>
                    @csrf
					<fieldset>
						<legend><i class="far fa-plus-square"></i> &nbsp; Devis</legend>
						<div class="container-fluid">
                            <div class="form-row">
                                <div class="col col-md-6">
                                    <label for="inputName">N°</label>
                                    <input type="text" class="form-control mb-4" name="inputName"  placeholder="Nom de l'article" value="{{ old('inputName') }}">
                                    @error('inputName')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="md-form col-md-6">
                                <label for="date">Date</label>
                                <input type="text" class="form-control" name="date" placeholder="Date devis" value="{{ old('date') }}">
                                    @error('date')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="md-form col-md-6 ">
                                    <label for="tier">Fournisseur</label>
                                    <select name="tier" class="form-control" required>
                                        <option value="" selected="" disabled="">Selectionner un fournisseur</option>
                                        @forelse($tiers as $tier)
                                            <option value="{{ $tier->id }}"
                                                @if(old('tier') == $tier->id)
                                                    {{ 'selected' }}>{{ $tier->name }}</option>
                                        @empty
                                            <option value=''>Aucun fournisseur </option>
                                        @endforelse
                                    </select>
                                    @error('inputWarehouse')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="md-form col-md-6 ">
                                <label for="inputStandard_price">Prix tandard </label>
                                <input type="number" class="form-control" name="inputStandard_price" placeholder="Prix standard" value="{{ old('inputStandard_price') }}">
                                @error('inputStandard_price')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>
                                <div class="md-form col-md-3 mt-4">
                                <label for="inputStock_alerte">Stock alerte</label>
                                <input type="number" class="form-control" name="inputStock_alerte" placeholder="Stock minimal" value="{{ old('inputStandard_price') }}">
                                @error('inputStock_alerte')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>
                                <div class="md-form col-md-3 mt-4">
                                <label for="inputOptimal_stock">Stock optimale </label>
                                <input type="number" class="form-control" name="inputOptimal_stock" placeholder="Stock optimale " value="{{ old('inputOptimal_stock') }}">
                                @error('inputOptimal_stock')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>
                            </div>
                        </div>
					</fieldset>
					<br><br><br>
					<fieldset>
                        <legend><i class="far fa-address-card"></i> &nbsp; Information supplémentaires</legend>
						<div class="container-fluid">

                        <div class="form-row">
                                <div class="form-group col-md-4">
                                <label for="inputWarehouse">Entrepôt par défaut</label>
                                <select name="inputWarehouse" class="form-control">
                                    <option value="" selected="" disabled="">Selectionner un entrepôt</option>
                                    @forelse($Warehouses as $Warehouse)
                                        <option value="{{ $Warehouse->id }}" {{ old('inputWarehouse') == '$Warehouse->id' ? 'selected' : '' }}>{{ $Warehouse->name }}</option>
                                    @empty
                                        <option value=''>Aucun entrepot </option>
                                    @endforelse
                                </select>
                                @error('inputWarehouse')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>
                                <div class="form-group col-md-4">
                                <label for="inputProcurement">Méthode d'approvisionnement</label>
                                <select name="inputProcurement" class="form-control">
                                    <option value="" selected="" disabled="">Selectionner une méthode</option>
                                    <option value='SurDemande' {{ old('titinputProcurementle') == 'SurDemande' ? 'selected' : '' }}>Sur demande</option>
                                    <option value='Automantique'{{ old('inputProcurement') == 'Automantique' ? 'selected' : '' }}>Automatique</option>
                                </select>
                                </div>
                                <div class="form-group col-md-4">
                                <label for="inputType">Type</label>
                                <select name="inputType" class="form-control">
                                    <option value="" selected="" disabled="">Selectionner un type</option>
                                    <option value='stockable' {{ old('inputType') == 'stockable' ? 'selected' : '' }}>Stockable</option>
                                    <option value='service'{{ old('inputType') == 'service' ? 'selected' : '' }}>Service</option>
                                </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                <label for="inputTaxe">Taxe par défaut</label>
                                <select name="inputTaxe" class="form-control">
                                   <option value="" selected="" disabled="">Selectionner une taxe</option>
                                    @forelse($Taxes as $Taxe)
                                        <option value="{{ $Taxe->id }}" {{ old('inputTaxe') == '$Taxe->id' ? 'selected' : '' }}>{{ $Taxe->name }}</option>
                                    @empty
                                        <option value=''>Aucune Taxe </option>
                                    @endforelse
                                </select>
                                @error('inputTaxe')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>
                                <div class="form-group col-md-4">
                                <label for="inputCategory_product">Catégorie du produit</label>
                                <select name="inputCategory_product" class="form-control">
                                <option value="" selected="" disabled="">Selectionner une catégorie</option>
                                @forelse($Category_products as $Category_product)
                                        <option value="{{ $Category_product->id }}" {{ old('inputCategory_product') == '$Category_product->id' ? 'selected' : '' }}>{{ $Category_product->name }}</option>
                                    @empty
                                        <option value=''>Aucun Category_product </option>
                                    @endforelse
                                </select>
                                @error('inputCategory_product')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>
                                <div class="form-group col-md-4">
                                <label for="inputProduct_unities">Product unities</label>
                                <select name="inputProduct_unities" class="form-control">
                                <option value="" selected="" disabled="">Selectionner une unité</option>
                                @forelse($Product_unities as $Product_unity)
                                        <option value="{{ $Product_unity->id }}" {{ old('inputProduct_unities') == '$Product_unity->id' ? 'selected' : '' }}>{{ $Product_unity->name }}</option>
                                    @empty
                                        <option value=''>Aucun Product_unity </option>
                                    @endforelse
                                </select>
                                @error('inputProduct_unities')
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

    var lien=<?php  echo json_encode("Nouveau"); ?>;
    var url="/products/create";
    $('.breadcrumb-item').removeClass('active');
    $('.breadcrumb').append('<a class="breadcrumb-item active" href='+url+' >'+lien+'</a>');

    });
    </script>
@endsection
