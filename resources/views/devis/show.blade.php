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
                @include('devis.breadcumb')

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
                       <a href="{{ route('devis.show',["devi"=>$id_previous->id]) }}" class="btn btn-raised btn btn" ><i class="fas fa-chevron-left"></i></a>
                    <li>
                        <a href="{{route('devis.index')}}"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTE DES DEVIS</a>
                    </li>
                        <a href="{{ route('devis.show',["devi"=>$id_next->id ]) }}" class="btn btn-raised btn btn" ><i class="fas fa-chevron-right"></i></a>
                </ul>
            </div>

            <!--CONTENT-->
            <div class="container-fluid">
            <form class="form-neon"  action="/confirm_purchase/{{$purchase_order->id}}"  autocomplete="off">
                    @csrf
                    @method('PUT')
                    <fieldset>
                        <div class="container-fluid">

                        </div>

                            <div class="row justify-content-between">
                                <div class="col-4">
                                    @if (count($purchase_order->order_lines)!=0)
                                    <button type="submit"  class="btn btn-raised btn-info btn-sm" >Confirmer l'achat</button>
                                    @endif

                                </div>
                                <div class="col-4">
                                    <button type="button" class="btn btn-raised btn-info btn-sm" style="float:right;background:#4caf50">{{ $purchase_order->state }}</button>
                                </div>
                              </div>



                        <div class="form-row">
                           <div class="form-group col-md-4 mt-4">
                                <span class="roboto-medium">Nom :</span>
                                <span>{{ $purchase_order->name }}</span>
                            </div>
                            <div class="form-group col-md-4 mt-4">
                                <span class="roboto-medium">Date :</span>
                                <span>{{ $purchase_order->date }}</span>
                            </div>
                            <div class="form-group col-md-4 mt-4">
                                <span class="roboto-medium">Condition de réglement :</span>
                                <span>{{ $purchase_order->condition_reglement ." Jours"}}</span>
                            </div>
                        </div>
                        <div class="form-row">
                           <div class="form-group col-md-4 mt-3" data-toggle="modal" data-target="#exampleModalF">
                                <span class="roboto-medium">Fournisseur :</span>
                                <span>
                                @foreach($tiers as $tier)
                                  @if ($purchase_order->tier_id == $tier->id)
                                     {{$tier->name}}
                                    @endif
                                @endforeach
                                </span>
                            </div>
                            
                            <div class="form-group col-md-4 mt-3">
                                <span class="roboto-medium">Liste de prix :</span>
                            <span>{{ $purchase_order->list_price->name }}</span>
                            </div>
                            <div class="form-group col-md-4 mt-3">
                                <span class="roboto-medium">date prévue de livraison :</span>
                            <span>{{ $purchase_order->date_shippement }}</span>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-dark table-sm ">
                                <thead>
                                    <tr class="text-center roboto-medium">
                                        <th>Article</th>
                                        <th>Code</th>
                                        <th>Unité</th>
                                        <th>Quantité</th>
                                        <th>Prix</th>
                                        <th>Taxe</th>
                                        <th>Entrepot de destination</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($purchase_order->order_lines as $purchase_order_line)
                                    <tr class="text-center" data-toggle="modal" data-target="#exampleModalP{{$purchase_order_line['id']}}" >
                                        <td>
                                        {{ $purchase_order_line->product->name}}

                                        </td>
                                        <td>
                                            {{ $purchase_order_line->product->ref}}

                                        </td>
                                        <td>
                                        {{ $purchase_order_line->unity->name}}

                                        </td>
                                        <td>

                                            {{$purchase_order_line->product_qty}}

                                        </td>
                                        <td>
                                        {{ $purchase_order_line->price_unit}}

                                        </td>
                                        <td>
                                            {{ $purchase_order_line->taxe->name ?? "Aucune taxe"}}

                                        </td>
                                        <td>
                                            {{ $purchase_order_line->warehouse->name }}
                                        </td>
                                        <td>
                                            {{ $purchase_order_line->amount }}
                                        </td>
                                        <!-- Modal -->
                                        <div class="modal fade bd-example-modal-sm" id="exampleModalP{{$purchase_order_line['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalP{{$purchase_order_line['id']}}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h2 class="swal2-title" id="swal2-title" style="display: flex;">Produit : {{$purchase_order_line->product->name ?? ''}}</h2>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">  
                                            <div class="form-row">
                                                            <legend><i class="fas fa-pallet fa-fw"></i> &nbsp; Informations sur l'article</legend>
                                                            <br>
                                                            <div class="container-fluid">
                                                                    <div class="form-row">
                                                                        <div class="md-form col-md-4 mt-4">
                                                                        <label for="inputRef">Réference :</label>
                                                                        <label for="inputName"> <strong> {{$purchase_order_line->product->ref}}</strong></label>
                                                                        </div>
                                                                        <div class="md-form col-md-4 mt-4">
                                                                        <label for="inputRef">Stock virtuel :</label>
                                                                        <label for="inputName"> <strong> {{$purchase_order_line->product->virtual_stock}}</strong></label>
                                                                        </div>
                                                                        <div class="md-form col-md-4 mt-4">
                                                                        <label for="inputRef">Stock physique :</label>
                                                                        <label for="inputName"> <strong> {{$purchase_order_line->product->physical_stock}}</strong></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="md-form col-md-3 mt-4">
                                                                        <label for="inputSale_price">Prix de vente :</label>
                                                                        <label for="inputName"> <strong> {{$purchase_order_line->product->sale_price}}</strong></label>
                                                                        </div>
                                                                        <div class="md-form col-md-3 mt-4">
                                                                        <label for="inputStandard_price">Prix d'achat :</label>
                                                                        <label for="inputName"> <strong> {{$purchase_order_line->product->standard_price}}</strong></label>
                                                                        </div>
                                                                        <div class="md-form col-md-3 mt-4">
                                                                        <label for="inputStock_alerte">Stock alerte :</label>
                                                                        <label for="inputName"> <strong> {{$purchase_order_line->product->alerte_stock}}</strong></label>
                                                                        </div>
                                                                        <div class="md-form col-md-3 mt-4">
                                                                        <label for="inputStock_alerte">Stock optimal :</label>
                                                                        <label for="inputName"> <strong> {{$purchase_order_line->product->optimal_stock}}</strong></label>
                                                                        </div>
                                                                    </div>
                                                             </div>
                                                             <br><br><br>

                                                        <br><br><br>
                                                            <legend><i class="far fa-plus-square"></i> &nbsp; Informations supplémentaire</legend>
                                                            <div class="container-fluid">
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-4 mt-4">
                                                                        <label for="inputWarehouse">Entrepôt par défaut :</label>
                                                                        <label for="inputName"> <strong>{{$purchase_order_line->product->warehouse->name}}</strong></label>
                                                                        </div>
                                                                        <div class="form-group col-md-4 mt-4">
                                                                        <label for="inputProcurement">Approvisionnement :</label>
                                                                        <label for="inputName"> <strong> {{$purchase_order_line->product->procurement_method}} </strong></label>
                                                                        </div>
                                                                        <div class="form-group col-md-4 mt-4">
                                                                        <label for="inputType">Type :</label>
                                                                        <label for="inputName"> <strong> {{$purchase_order_line->product->type}} </strong></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-4">
                                                                        <label for="inputTaxe">Taxe par défaut :</label>
                                                                        <label for="inputName"> <strong> 
                                                                        @foreach($Taxes as $taxe)
                                                                            @if($purchase_order_line->product->taxe_id == $taxe->id)
                                                                            {{ $taxe->name }}
                                                                            @endif
                                                                        @endforeach
                                                                        </strong></label>
                                                                        </div>
                                                                        <div class="form-group col-md-4">
                                                                        <label for="inputCategory_product">Catégorie du produit :</label>
                                                                        <label for="inputName"> <strong> 
                                                                        @foreach($Category_products as $category_product)
                                                                            @if($purchase_order_line->product->category_product_id == $category_product->id)
                                                                            {{ $category_product->name }}
                                                                            @endif
                                                                        @endforeach
                                                                        </strong></label>
                                                                        </div>
                                                                        <div class="form-group col-md-4">
                                                                        <label for="inputProduct_unities"> Unité du produit :</label>
                                                                        <label for="inputName"> <strong>
                                                                        @foreach($Product_unities as $product_unity)
                                                                        @if($purchase_order_line->product->unity_id == $product_unity->id)
                                                                            {{ $product_unity->name }}
                                                                            @endif
                                                                        @endforeach
                                                                        </strong></label>
                                                                        </div>
                                                                    </div>
                                                            </div>
                                            </div>     
                                            </div>
                                            <div class="modal-footer">
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                        <!-- modal fin -->
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-dark table-sm mt-500">
                                <tbody>
                                    <tr class="text-center" >
                                        <td>Total hors taxe :</td>
                                    <td>{{ $purchase_order->ammount_ht }} {{ $purchase_order->list_price->currency->symbole }}</td>
                                    </tr>
                                    <tr class="text-center" >
                                        <td>Total taxes :</td>
                                        <td>{{ $purchase_order->ammount_tax }} {{ $purchase_order->list_price->currency->symbole }}</td>
                                    </tr>
                                    <tr class="text-center" >
                                        <td>Total remises :</td>
                                        <td>{{ $purchase_order->remise }} {{ $purchase_order->list_price->currency->symbole }}</td>
                                    </tr>
                                    <tr class="text-center" >
                                        <td>Total :</td>
                                        <td>{{ $purchase_order->ammount_total }} {{ $purchase_order->list_price->currency->symbole }}</td>
                                    </tr>
                                </tbody>
                            </table>
                               
                            <!-- Modal Fournisseur -->
                            <div class="modal fade bd-example-modal-sm" id="exampleModalF" tabindex="-1" role="dialog" aria-labelledby="exampleModalF" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h2 class="swal2-title" id="swal2-title" style="display: flex;">Fournisseur : {{$purchase_order->tier->name}}</h2>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                            <div class="form-row">
                                            <div class="container-fluid">
                                                <form class="form-neon" autocomplete="off">
                                                    <fieldset>
                                                        <legend><i class="fas fa-truck fa-fw"></i> &nbsp; Informations sur le fournisseur</legend>
                                                        <div class="container-fluid">
                                                                <div class="form-row">
                                                                    <div class="md-form col-md-6 mt-4">
                                                                    <label for="inputName">Nom :</label>
                                                                    <label for="inputName"> <strong> {{$purchase_order->tier->name}}</strong></label>
                                                                    </div>
                                                                    <div class="md-form  col-md-6 mt-4">
                                                                    <label for="inputCode">Code :</label>
                                                                    <label for="inputName"> <strong> {{$purchase_order->tier->code}}</strong></label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row">
                                                                    <div class="md-form col-md-4 mt-4">
                                                                    <label for="inputPays">Pays :</label>
                                                                    <label for="inputName"> <strong> {{$purchase_order->tier->pays ?? 'Non renseigner'}}</strong></label>
                                                                    </div>
                                                                    <div class="md-form col-md-4 mt-4">
                                                                    <label for="inputAdresse">Adresse :</label>
                                                                    <label for="inputName"> <strong> {{$purchase_order->tier->adresse ?? 'Non renseigner'}}</strong></label>
                                                                    </div>
                                                                    <div class="md-form  col-md-4 mt-4">
                                                                    <label for="inputCodeP">Code postal :</label>
                                                                    <label for="inputName"> <strong> {{$purchase_order->tier->code_postal}}</strong></label>
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
                                                                    <label for="inputPhone">Numéro :</label>
                                                                    <label for="inputName"> <strong> {{$purchase_order->tier->phone}}</strong></label>
                                                                    </div>
                                                                    <div class="md-form col-md-4 mt-4">
                                                                    <label for="inputEmail" data-error="wrong" data-success="right">Email  :</label>
                                                                    <label for="inputName"> <strong> {{$purchase_order->tier->Email}}</strong></label>
                                                                    </div>
                                                                    <div class="md-form col-md-4 mt-4">
                                                                    <label for="inputWeb">Site web :</label>
                                                                    <label for="inputName"> <strong> {{$purchase_order->tier->web ?? 'Non renseigner'}}</strong></label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-6 mt-4">
                                                                    <label for="inputList_prices_id">Liste de prix :</label>
                                                                    <label for="inputName">
                                                                    <strong>
                                                                    @foreach($list_prices as $list_price)
                                                                        @if($purchase_order->tier->list_price_id == $list_price->id)
                                                                        {{ $list_price->name }}
                                                                        @endif
                                                                    @endforeach
                                                                    </strong></label>
                                                                </div>
                                                                <div class="md-form col-md-6 mt-4">
                                                                    <label for="delai">Délai de livraison : </label>
                                                                    <label for="delai"> <strong> {{$purchase_order->tier->delai ." Jours"}} </strong></label>
                                                                </div>
                                                        </div>
                                                    </fieldset>
                                                </form>
                                            </div>     
                                            </div>
                                            <div class="modal-footer">
                                            </div>
                                        </div>
                            </div>
                        </div>
                        <!-- MODAL FIN-->
                     </div>
                  </fieldset>
                <p class="text-center" style="margin-top: 40px;">
                 <button  onclick="document.location='/devis/{{$purchase_order->id}}/edit'" type="button" class="btn btn-raised btn-info btn-sm" ><i class="far fa-save"></i> &nbsp; MODIFIER</button>
                 &nbsp; &nbsp;
                 <a target="_blank" href='/devis/{{$purchase_order->id}}/pdf' class="btn btn-raised btn-info btn-sm" ><i class="fas fa-file-pdf"></i> &nbsp; IMPRIMER</a>
				</p>
             </form>
           	</div>
        </section>
</main>
@endsection
@section('jsnagh')
<script>
$(document).ready(function() {
            var id=<?php  echo json_encode($purchase_order->id); ?>;
            var lien=<?php  echo json_encode($purchase_order->name); ?>;
            var url="/devis/"+id;
            $('.breadcrumb-item').removeClass('active');
            $('.breadcrumb').append('<a class="breadcrumb-item active" href='+url+' >'+lien+'</a>');
            });
</script>
@endsection

















