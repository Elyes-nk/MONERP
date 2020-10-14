
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
                @include('commandes.breadcumb')
            </div>
            <div class="container-fluid">
                <ul class="full-box list-unstyled page-nav-tabs">
                       <a href="{{ route('commandes.show',["commande"=>$id_previous->id]) }}" class="btn btn-raised btn btn" ><i class="fas fa-chevron-left"></i></a>
                    <li>
                        <a href="{{route('commandes.index')}}"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTE DES COMMANDES</a>
                    </li>
                        <a href="{{ route('commandes.show',["commande"=>$id_next->id ]) }}" class="btn btn-raised btn btn" ><i class="fas fa-chevron-right"></i></a>
                </ul>
            </div>
            <!--CONTENT-->
            <div class="container-fluid">
            <form class="form-neon"  autocomplete="off">
                <div class="container-fluid">

                    <div class="row justify-content-between">
                        <div class="col-8">
                        <a href="{{route('receptions.index',["name"=>$purchase_order->name,"order"=>$purchase_order->id]) }}" class="btn btn-raised btn-info btn-sm">Voir les réceptions</a>
                            @if ($purchase_order->state=="confirmed")
                                @if(Auth::user()->role == 'Financier' OR Auth::user()->role == 'Administrateur')
                                    @if ($purchase_order->receptions->first()->state!="Reçu")
                                    <a href="{{ route('receptions.show',['reception'=>$purchase_order->receptions->first()->id]) }}"  class="btn btn-raised btn-info btn-sm">Réception des articles</a>
                                    @endif
                                <a href="{{ route('bills.show',['bill'=>$purchase_order->invoice->first()->id]) }}"  class="btn btn-raised btn-info btn-sm">Voir facture</a>
                                @endif
                                @if(Auth::user()->role == 'Financier' OR Auth::user()->role == 'Administrateur')
                                <button type="button"  class="btn btn-raised btn-info btn-sm" data-target="#exampleModal" data-toggle="modal">Annuler l'achat</button>

                                <!-- Modal -->
                                <div class="modal fade bd-example-modal-sm" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal{{$purchase_order->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h2 class="swal2-title" id="swal2-title" style="display: flex;">Commande : {{$purchase_order->name}}</h2>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        @php
                                            $moves=0;
                                        @endphp
                                        @foreach ($purchase_order->receptions as $reception)
                                            @php
                                                if($reception->state=="Reçu"){
                                                    $moves=1;
                                                }
                                            @endphp
                                        @endforeach
                                        @if ($moves==1)
                                            Attention! Vous avez déja effectuer des réceptions suite à cette commande.
                                            Pour pouvoir annuler cette commande, il faut d'abord annuler ses réceptions.
                                        @else
                                        Voulez-vous vraiment annuler cette commande?
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        @if ($moves==1)
                                        <button class="swal2-confirm swal2-styled"
                                        style="display: inline-block; background-color: rgb(48, 133, 214); border-left-color: rgb(48, 133, 214); border-right-color: rgb(48, 133, 214);"
                                        type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Fermer</button>
                                        @else
                                    <form action="/cancel_order/{{$purchase_order->id}}" >
                                        @csrf
                                        @method('PATCH')
                                            <a href="{{route('cancel.order',['id'=>$purchase_order->id])}}" class="swal2-cancel swal2-styled" aria-label style="display: inline-block; background-color: rgb(221, 51, 51);"
                                             class="btn btn-warning">
                                                    Confirmer l'annulation
                                    </a>
                                        </form>
                                        <button class="swal2-confirm swal2-styled"
                                        style="display: inline-block; background-color: rgb(48, 133, 214); border-left-color: rgb(48, 133, 214); border-right-color: rgb(48, 133, 214);"
                                        type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Fermer</button>
                                        @endif
                                    </div>
                                    </div>
                                </div>
                                </div>
                            @endif
                            @else
                            @endif
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-raised btn-info btn-sm" style="float:right;background:#4caf50" > @if($purchase_order->state=="confirmed")
                            {{ "Confirmé"}}
                            @else
                            {{ $purchase_order->state }}
                            @endif
                        </div>
                    </div>
                    <fieldset>
                    <div class="container-fluid">
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
                           <div class="form-group col-md-4 mt-3"  data-toggle="modal" data-target="#exampleModalF">
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
                                <span class="roboto-medium">Date prévue de livraison :</span>
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
                                        <th>Entrepôt de destination</th>
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
                                            {{ $purchase_order_line->taxe->name OR "Aucune taxe"}}

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
                        </div>
                     </div>
                  </fieldset>
                  <p class="text-center" style="margin-top: 40px;">
                    <a target="_blank" href='/commandes/{{$purchase_order->id}}/pdf' class="btn btn-raised btn-info btn-sm" ><i class="fas fa-file-pdf"></i> &nbsp; IMPRIMER</a>
                  </p>
             </form>
           	</div>
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
                                            </div>     
                                            </div>
                                            <div class="modal-footer">
                                            </div>
                                        </div>
                            </div>
                        </div>
                        <!-- MODAL FIN-->
        </section>
</main>
@endsection
@section('jsnagh')
<script>
    $("#exampleModal").on('shown.bs.modal', function () {
      $("#myInput").trigger('focus')
    })
    </script>
    <script>$(document).ready(function() {
            var id=<?php  echo json_encode($purchase_order->id); ?>;
            var lien=<?php  echo json_encode($purchase_order->name); ?>;
            var url="/commandes/"+id;
            $('.breadcrumb-item').removeClass('active');
            $('.breadcrumb').append('<a class="breadcrumb-item active" href='+url+' >'+lien+'</a>');
            });</script>
@endsection

















