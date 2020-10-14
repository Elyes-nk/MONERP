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
                    <i class="fas fa-pallet fa-fw"></i> &nbsp; INFORMATIONS SUR L'ARTICLE
                </h3>
                @include('products.breadcumb')
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
                        <a href="{{route('products.create')}}"><i class="fas fa-plus fa-fw"></i> &nbsp; AJOUTER UN ARTICLE</a>
                    </li>
                       <a href="{{ route('products.show',["product"=>$id_previous->id]) }}" class="btn btn-raised btn btn" ><i class="fas fa-chevron-left"></i></a>
                    <li>
                        <a href="{{route('products.index')}}"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTE DES ARTICLES</a>
                    </li>
                        <a href="{{ route('products.show',["product"=>$id_next->id ]) }}" class="btn btn-raised btn btn" ><i class="fas fa-chevron-right"></i></a>                    
                </ul>
            </div>

            <!--CONTENT-->
            <div class="container-fluid">
                <form class="form-neon" autocomplete="off" >
					<fieldset>
						<legend><i class="fas fa-pallet fa-fw"></i> &nbsp; Informations sur l'article</legend>
						<div class="container-fluid">
                        <br>
                            <div class="form-row">
                                <div class="col col-md-3">
                                    <label for="inputName">Nom :</label>
                                    <label for="inputName"> <strong> {{$product->name}}</strong></label>
                                </div>
                                <div class="md-form col-md-3">
                                <label for="inputRef">Réference :</label>
                                <label for="inputName"> <strong> {{$product->ref}}</strong></label>
                                </div>
                                <div class="md-form col-md-3">
                                <label for="inputRef">Stock virtuel :</label>
                                <label for="inputName"> <strong> {{$product->virtual_stock}}</strong></label>
                                </div>
                                <div class="md-form col-md-3">
                                <label for="inputRef">Stock physique :</label>
                                <label for="inputName"> <strong> {{$product->physical_stock}}</strong></label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="md-form col-md-3 mt-4">
                                <label for="inputSale_price">Prix de vente :</label>
                                <label for="inputName"> <strong> {{$product->sale_price}}</strong></label>

                                </div>
                                <div class="md-form col-md-3 mt-4">
                                <label for="inputStandard_price">Prix d'achat :</label>
                                <label for="inputName"> <strong> {{$product->standard_price}}</strong></label>

                                </div>
                                <div class="md-form col-md-3 mt-4">
                                <label for="inputStock_alerte">Stock alerte :</label>
                                <label for="inputName"> <strong> {{$product->alerte_stock}}</strong></label>

                                </div>
                                <div class="md-form col-md-3 mt-4">
                                <label for="inputOptimal_stock">Stock optimal :</label>
                                <label for="inputName"> <strong> {{$product->optimal_stock}}</strong></label>

                                </div>
                            </div>
                        </div>
					</fieldset>
                    <br>
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
                        <br>
                        <div class="form-row">
                                <div class="form-group col-md-4">
                                <label for="inputWarehouse">Entrepôt par défaut :</label>
                                <label for="inputName"> <strong>
                                @foreach($Warehouses as $warehouse)
                                    @if($product->warehouse_id == $warehouse->id)
                                      {{ $warehouse->name }}
                                    @endif
                                @endforeach
                                </strong></label>

                                </div>
                                <div class="form-group col-md-4">
                                <label for="inputProcurement">Approvisionnement :</label>
                                <label for="inputName"> <strong> {{$product->procurement_method}} </strong></label>
                                </div>
                                <div class="form-group col-md-4">
                                <label for="inputType">Type :</label>
                                <label for="inputName"> <strong> {{$product->type}} </strong></label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                <label for="inputTaxe">Taxe par défaut :</label>
                                <label for="inputName"> <strong>
                                @foreach($Taxes as $taxe)
                                    @if($product->taxe_id == $taxe->id)
                                      {{ $taxe->name }}
                                    @endif
                                @endforeach
                                </strong></label>

                                </div>
                                <div class="form-group col-md-4">
                                <label for="inputCategory_product">Catégorie du produit :</label>
                                <label for="inputName"> <strong>
                                @foreach($Category_products as $category_product)
                                    @if($product->category_product_id == $category_product->id)
                                      {{ $category_product->name }}
                                    @endif
                                @endforeach
                                </strong></label>

                                </div>
                                <div class="form-group col-md-4">
                                <label for="inputProduct_unities"> Unité du produit :</label>
                                <label for="inputName"> <strong>
                                @foreach($Product_unities as $product_unity)
                                @if($product->unity_id == $product_unity->id)
                                      {{ $product_unity->name }}
                                    @endif
                                @endforeach
                                </strong></label>

                                </div>
                           </div>
                           </div>
                      </div>
                      <div class="tab-pane fade " id="appro" > <br>
                        <div class="container-fluid">
                            <div class="table-responsive">
                                <table class="table table-dark table-sm " name="lignes">
                                    <thead>
                                        <tr class="text-center roboto-medium">
                                            <th>Fournisseur</th>
                                            <th>Délai de livraison</th>
                                            <th>Prix d'acquisition</th>
                                            <th>Quantité minimale autorisé</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($product->suppliers)==0)
                                            <tr>
                                            <td colspan="4">Vous n'avez pas de fournisseur pour ce produit.</td>
                                            </tr>
                                        @else
                                            @foreach ($product->suppliers as $line)
                                                <tr class="text-center">
                                                    <td><input type="text" class="form-control "    value="{{ $line->tier->name }}" readonly></td>
                                                    <td><input type="text" class="form-control "    value="{{ $line->delai }}" readonly></td>
                                                    <td><input type="text" class="form-control "    value="{{ $line->price }}" readonly></td>
                                                    <td><input type="text" class="form-control "    value=" {{ $line->qtt_min }}" readonly></td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                      </div>
                        </div>
					</fieldset>
					<p class="text-center" style="margin-top: 40px;">
						<button  onclick="document.location='/products/{{$product->id}}/edit'" type="button" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; MODIFIER</button>
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
       var id=<?php  echo json_encode($product->id); ?>;
        var lien=<?php  echo json_encode('['.$product->ref.']'.' '.$product->name); ?>;
        var url="/products/"+id;
        $('.breadcrumb-item').removeClass('active');
        $('.breadcrumb').append('<a class="breadcrumb-item active" href='+url+' >'+lien+'</a>');

        });</script>
@endsection
