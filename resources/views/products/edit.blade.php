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
                    <i class="fas fa-sync-alt"></i> &nbsp; MODIFIER UN ARTICLE
                </h3>
                @include('products.breadcumb')
            </div>
            <div class="container-fluid">
                <ul class="full-box list-unstyled page-nav-tabs">
                    <li>
                        <a  href="{{route('products.create')}}"><i class="fas fa-plus fa-fw"></i> &nbsp; AJOUTER UN ARTICLE</a>
                    </li>
                    <li>
                        <a href="{{route('products.index')}}"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTE DES ARTICLES</a>
                    </li>
                </ul>
            </div>

            <!--CONTENT-->
            <div class="container-fluid">
                <form action="{{route('products.update',["product"=>$product->id])}}" class="form-neon" autocomplete="off" method='post'>
                    @csrf
                    @method('PATCH')
                    <fieldset>
                        <legend><i class="far fa-plus-square"></i> &nbsp; Informations de l'article</legend>
                        <div class="container-fluid">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                <label for="inputName">Nom</label>
                                <input type="text" class="form-control" name="inputName" placeholder="Procurement" value="{{ $product->name }}">
                                @error('inputName')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>
                                <div class="form-group col-md-6">
                                <label for="inputRef">Réference </label>
                                <input type="text" class="form-control" name="inputRef" placeholder="Réference" value="{{ $product->ref }}" @error('inputRef')
                                style="border:1px solid red"
                                @enderror>

                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3 mt-4">
                                <label for="inputSale_price">Prix de vente </label>
                                <input type="number" class="form-control" name="inputSale_price" placeholder="Prix" value="{{ $product->sale_price }}"
                                @error('inputSale_price')
                                style="border:1px solid red"
                                @enderror
                                >

                                </div>
                                <div class="form-group col-md-3 mt-4">
                                <label for="inputStandard_price">Prix d'achat </label>
                                <input type="number" class="form-control" name="inputStandard_price" placeholder="Prix" value="{{ $product->standard_price}}"
                                @error('inputStandard_price')
                                style="border:1px solid red"
                                @enderror
                                >

                                </div>
                                <div class="form-group col-md-3 mt-4">
                                <label for="inputStock_alerte">Stock alerte</label>
                                <input type="number" class="form-control" name="inputStock_alerte" placeholder="Prix" value="{{ $product->alerte_stock }}"
                                @error('inputStock_alerte')
                                style="border:1px solid red"
                                @enderror
                                >

                                </div>
                                <div class="form-group col-md-3 mt-4">
                                <label for="inputOptimal_stock">Stock optimale</label>
                                <input type="number" class="form-control" name="inputOptimal_stock" placeholder="Optimal_stock" value="{{ $product->optimal_stock }}"
                                @error('inputOptimal_stock')
                                style="border:1px solid red"
                                @enderror
                                >

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


                        <div class="container-fluid">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                <label for="inputWarehouse">Entrepot par défaut</label>
                                <select name="inputWarehouse" class="form-control js-example-basic-multiple" @error('inputWarehouse')
                                style="border:1px solid red"
                                @enderror>
                                    @forelse($Warehouses as $Warehouse)
                                        <option value="{{ $Warehouse->id }}"  {{ $product->warehouse_id == '$Warehouse->id' ? 'selected' : '' }}>{{ $Warehouse->name }}</option>
                                    @empty
                                        <option value=''>Aucun entrepot </option>
                                    @endforelse
                                </select>

                                </div>
                                <div class="form-group col-md-4">
                                <label for="inputProcurement">Méthode de réapprovisionnement</label>
                                <select name="inputProcurement" class="form-control js-example-basic-multiple">
                                    <option value='Planifié' @if ( $product->procurement_method == 'Planifié')
                                        {{  'selected'  }}
                                    @endif >Planifié</option>
                                    <option value='Automatique' @if ($product->procurement_method == 'Automatique')
                                        {{  'selected'  }}
                                    @endif >Automatique</option>
                                </select>
                                </div>
                                <div class="form-group col-md-4">
                                <label for="inputType">Type</label>
                                <select name="inputType" class="form-control js-example-basic-multiple">
                                    <option value='stockable' {{ $product->type == 'stockable' ? 'selected' : '' }}>Stockable</option>
                                    <option value='service' {{ $product->type == 'service' ? 'selected' : '' }}>Service</option>
                                </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                <label for="inputTaxe">Taxe par défaut</label>
                                <select name="inputTaxe" class="form-control js-example-basic-multiple" @error('inputTaxe')
                                style="border:1px solid red"
                                @enderror>
                                    @forelse($Taxes as $Taxe)
                                        <option value="{{ $Taxe->id }}"  {{ $product->taxe_id == '$Taxe->id' ? 'selected' : '' }}>{{ $Taxe->name }}</option>
                                    @empty
                                        <option value=''>Aucune Taxe </option>
                                    @endforelse
                                </select>

                                </div>

                                <div class="form-group col-md-4">
                                <label for="inputCategory_product">Catégorie du produit</label>
                                <select name="inputCategory_product" class="form-control js-example-basic-multiple" @error('inputCategory_product')
                                style="border:1px solid red"
                                @enderror>
                                @forelse($Category_products as $Category_product)
                                        <option value="{{ $Category_product->id }}"  {{ $product->category_product_id == '$Category_product->id' ? 'selected' : '' }}>{{ $Category_product->name }}</option>
                                    @empty
                                        <option value=''>Aucun Category_product </option>
                                    @endforelse
                                </select>

                                </div>
                                <div class="form-group col-md-4">
                                <label for="inputProduct_unities">Unités de produit</label>
                                <select name="inputProduct_unities" class="form-control js-example-basic-multiple" @error('inputProduct_unities')
                                style="border:1px solid red"
                                @enderror>
                                @forelse($Product_unities as $Product_unity)
                                        <option value="{{ $Product_unity->id }}"  @if ($product->product_unity_id== $Product_unity->id)
                                            {{   'selected'  }}
                                        @endif >{{ $Product_unity->name }}</option>
                                    @empty
                                        <option value=''>Aucun Product_unity </option>
                                    @endforelse
                                </select>

                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="tab-pane fade " id="appro" >
                            <div class="container-fluid">
                                <div class="table-responsive">

                @livewire('edit-product-supplier')
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
        var id=<?php  echo json_encode($product->id); ?>;
        var lien=<?php  echo json_encode($product->name); ?>;
        var url="/products/"+id;
        $('.breadcrumb-item').removeClass('active');
        $('.breadcrumb').append('<a class="breadcrumb-item" href='+url+' >'+lien+'</a> <a class="breadcrumb-item active" href="#">edit</a>');
        });
</script>
@endsection
