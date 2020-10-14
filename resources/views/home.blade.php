@extends('layouts.base')
@section('sidebar')
    @include('_partials._sidebar_accueil')
@endsection

@section('you')
	<main class="full-box main-container">
		<!-- contenu de la page -->
		<section class="full-box page-content">
            <!-- barre en haut -->
			@include('_partials._navbar')
			<div class="full-box page-header">
				<h3 class="text-left">
					<i class="fab fa-dashcube fa-fw"></i> &nbsp; ACCUEIL
				</h3>
            </div>

            @if(session()->has('no_sequence') 
            OR session()->has('no_CategoryProduct') 
            OR session()->has('no_ProductUnity')
            OR session()->has('no_Currency') 
            OR session()->has('no_Warehouse') 
            OR session()->has('no_Taxe')
            OR session()->has('no_ListPrice'))
                <div class="container-fluid">
                        <form  class="form-neon" autocomplete="off">
                            <fieldset>
                                <h4><i class="exclamation-triangle"></i> &nbsp; IMPORTANT !</h4>
                                <div class="container-fluid">

                                @if (session()->has('no_sequence'))
                                    <div class="container-fluid">
                                        <div class="alert alert-danger" role="alert">
                                            {{ session('no_sequence') }} <a href=" {{ route('generate.sequences') }}" class="btn btn-secondary">Génerer les séquences par défaut</a>
                                        </div>
                                    </div>
                                @endif
                                @if (session()->has('no_CategoryProduct'))
                                    <div class="container-fluid">
                                        <div class="alert alert-danger" role="alert">
                                            {{ session('no_CategoryProduct') }} <a href=" {{ route('categoryProducts.create') }}" class="btn btn-secondary">Ajouter une catégorie de produit</a>
                                        </div>
                                    </div>
                                @endif
                                @if (session()->has('no_ProductUnity'))
                                    <div class="container-fluid">
                                        <div class="alert alert-danger" role="alert">
                                            {{ session('no_ProductUnity') }} <a href=" {{ route('unityProducts.create') }}" class="btn btn-secondary">Ajouter une unité de produit</a>
                                        </div>
                                    </div>
                                @endif
                                @if (session()->has('no_Currency'))
                                    <div class="container-fluid">
                                        <div class="alert alert-danger" role="alert">
                                            {{ session('no_Currency') }} <a href=" {{ route('currencies.create') }}" class="btn btn-secondary">Ajouter une devise</a>
                                        </div>
                                    </div>
                                @endif
                                @if (session()->has('no_Warehouse'))
                                    <div class="container-fluid">
                                        <div class="alert alert-danger" role="alert">
                                            {{ session('no_Warehouse') }} <a href=" {{ route('warehouses.create') }}" class="btn btn-secondary">Ajouter un entrepôt</a>
                                        </div>
                                    </div>
                                @endif
                                @if (session()->has('no_Taxe'))
                                    <div class="container-fluid">
                                        <div class="alert alert-danger" role="alert">
                                            {{ session('no_taxe') }} <a href=" {{ route('taxes.create') }}" class="btn btn-secondary">Ajouter une taxe</a>
                                        </div>
                                    </div>
                                @endif
                                @if (session()->has('no_ListPrice'))
                                    <div class="container-fluid">
                                        <div class="alert alert-danger" role="alert">
                                            {{ session('no_ListPrice') }} <a href=" {{ route('listPrices.create') }}" class="btn btn-secondary">Ajouter une liste de prix</a>
                                        </div>
                                    </div>
                                @endif
                                </div>
                        </fieldset>
                    </form>
                </div>
            @endif
			@livewire('accueil')
		</section>
	</main>
@endsection
