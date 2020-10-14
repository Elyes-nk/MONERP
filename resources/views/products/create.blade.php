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
                    <i class="fas fa-plus fa-fw"></i> &nbsp; AJOUTER UN ARTICLE
                </h3>
                @include('products.breadcumb')
            </div>
            <div class="container-fluid">
                <ul class="full-box list-unstyled page-nav-tabs">
                    <li>
                        <a class="active" href="{{route('products.create')}}"><i class="fas fa-plus fa-fw"></i> &nbsp; AJOUTER UN ARTICLE</a>
                    </li>
                    <li>
                        <a href="{{route('products.index')}}"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTE DES ARTICLES</a>
                    </li>
                </ul>
            </div>

            <!--CONTENT-->
            <div class="container-fluid" id="form1">
                <form action="{{route('products.store')}}" class="form-neon" autocomplete="off" method='post'>

        @csrf
					<fieldset>
						<legend><i class="fas fa-pallet fa-fw"></i> &nbsp; Informations de l'article</legend>
						<div class="container-fluid">
                            <div class="form-row">
                                <div class="md-form col-md-4">
                                    <label for="inputName">Nom</label>
                                    <input type="text" class="form-control mb-4" name="inputName"  placeholder="Nom de l'article" value="{{ old('inputName') }}" >
                                    @error('inputName')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="md-form col-md-4">
                                <label for="inputCategory_product">Catégorie du produit</label>
                                <select name="inputCategory_product" class="js-example-basic-multiple" id="inputCategory_product" required>
                                <option value="" selected="" disabled="">Selectionner une catégorie</option>
                                @forelse($Category_products as $Category_product)
                                        <option value="{{ $Category_product->id }}" {{ old("inputCategory_product") == $Category_product->id ? "selected" : "" }}>{{ $Category_product->name }}</option>
                                    @empty
                                        <option value=''>Aucun Category_product </option>
                                    @endforelse
                                </select>
                                @error('inputCategory_product')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>
                                <div class="md-form col-md-4">
                                <label for="inputRef">Réference </label>
                                <input type="text" class="form-control" name="inputRef" placeholder="Réference de l'article" value="{{ old('inputRef') }}">
                                    @error('inputRef')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="md-form col-md-3 mt-4">
                                <label for="inputSale_price">Prix de vente </label>
                                <input type="number" class="form-control" name="inputSale_price" placeholder="Prix de vente" value="{{ old('inputSale_price') }}">
                                @error('inputSale_price')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>
                                <div class="md-form col-md-3 mt-4">
                                <label for="inputStandard_price">Prix d'achat </label>
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
					<br>
					<fieldset>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item " role="presentation">
                              <a class="nav-link active " id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="far fa-plus-square"></i> &nbsp; Information supplémentaires</a>
                            </li>
                            <li class="nav-item" role="presentation">
                              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#appro" role="tab" aria-controls="profile" aria-selected="false">Réapprovisionnement</a>
                            </li>

                          </ul>
                          <div class="tab-content" id="myTabContent">
                          <div class="tab-pane fade show active" id="home" >
					<div class="container-fluid " >

                        <div class="form-row">
                                <div class="form-group col-md-4">
                                <label for="inputWarehouse">Entrepôt par défaut</label>
                                <select name="inputWarehouse" class="form-control js-example-basic-multiple" id="inputWarehouse" required>
                                    <option value="" selected="" disabled="">Selectionner un entrepôt</option>
                                    @forelse($Warehouses as $Warehouse)
                                        <option value="{{ $Warehouse->id }}" {{ old('inputWarehouse') == $Warehouse->id ? 'selected' : '' }}>{{ $Warehouse->name }}</option>
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
                                <select name="inputProcurement" class="form-control js-example-basic-multiple" required>
                                    <option value="" selected="" disabled="">Selectionner une méthode</option>
                                    <option value='Planifié' {{ old('titinputProcurementle') == 'Planifié' ? 'selected' : '' }}>Planifié</option>
                                    <option value='Automatique'{{ old('inputProcurement') == 'Automatique' ? 'selected' : '' }}>Automatique</option>
                                </select>
                                </div>
                                <div class="form-group col-md-4">
                                <label for="inputType">Type</label>
                                <select name="inputType" class="form-control js-example-basic-multiple" required>
                                    <option value="" selected="" disabled="">Selectionner un type</option>
                                    <option value='stockable' {{ old('inputType') == 'stockable' ? 'selected' : '' }}>Stockable</option>
                                    <option value='service'{{ old('inputType') == 'service' ? 'selected' : '' }}>Service</option>
                                </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">

                                <label for="inputTaxe">Taxe par défaut</label>
                                <select name="inputTaxe" class="form-control js-example-basic-multiple" required>
                                   <option value="" selected="" disabled="">Selectionner une taxe</option>
                                    @forelse($Taxes as $Taxe)
                                        <option value="{{ $Taxe->id }}" {{ old('inputTaxe') == $Taxe->id ? 'selected' : '' }}>{{ $Taxe->name }}</option>
                                    @empty
                                        <option value=''>Aucune Taxe </option>
                                    @endforelse
                                </select>
                                @error('inputTaxe')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>

                                <div class="form-group col-md-6">
                                <label for="inputProduct_unities">Product unities</label>
                                <select name="inputProduct_unities" class="form-control js-example-basic-multiple" required>
                                <option value="" selected="" disabled="">Selectionner une unité</option>
                                @forelse($Product_unities as $Product_unity)
                                        <option value="{{ $Product_unity->id }}" {{ old('inputProduct_unities') == $Product_unity->id ? 'selected' : '' }}>{{ $Product_unity->name }}</option>
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
                          </div>
                          <div class="tab-pane fade " id="appro" >
                            <div class="container-fluid">
                                <div class="table-responsive">
                                  @livewire("replishippement-supplier")
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

    $('#myTab a').on('click', function (e) {
  e.preventDefault()
  $(this).tab('show')
})
$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
    var lien=<?php  echo json_encode("Nouveau"); ?>;
    var url="/products/create";
    $('.breadcrumb-item').removeClass('active');
    $('.breadcrumb').append('<a class="breadcrumb-item active" href='+url+' >'+lien+'</a>');

    });
    </script>
@endsection
