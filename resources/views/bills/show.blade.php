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
                @include('bills.breadcumb')
            </div>
            <!--CONTENT-->
            <div class="container-fluid">
                <ul class="full-box list-unstyled page-nav-tabs">
                       <a href="{{ route('bills.show',["bill"=>$id_previous->id]) }}" class="btn btn-raised btn btn" ><i class="fas fa-chevron-left"></i></a>
                    <li>
                        <a href="{{route('bills.index')}}"><i class="fas fa-clipboard-list fa-fw" ></i> &nbsp; LISTE DES FACTURES</a>
                    </li>
                        <a href="{{ route('bills.show',["bill"=>$id_next->id ]) }}" class="btn btn-raised btn btn" ><i class="fas fa-chevron-right"></i></a>
                </ul>
            </div>
            <div class="container-fluid">
            <form class="form-neon" sub autocomplete="off">
                <div class="container-fluid">
                    <div class="row justify-content-between">
                        <div class="col-6">
                            @if ($bill->state=="brouillon")
                            <a href="{{route('validate.bill',['id'=>$bill->id])}}"  class="btn btn-raised btn-info btn-sm" >Validé la facture</a>
                            @endif
                            @if ($bill->state=="Ouverte" OR $bill->state=="En échéance")
                            <a href="#" data-toggle="modal" data-target="#exampleModalCenter"  class="btn btn-raised btn-info btn-sm" >Ajouter un réglement</a>
                            @endif
                            @if ($bill->state!="Annulé")
                            <a href="#" data-toggle="modal" data-target="#examplecancel"  class="btn btn-raised btn-info btn-sm" >Annuler la facture</a>
                            <div class="modal fade bd-example-modal-sm" id="examplecancel" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h2 class="swal2-title" id="swal2-title" style="display: flex;">Facture : {{$bill['name'] ?? ''}}</h2>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        @if ($bill->state=="En échéance")
                                            Attention!! Si vous annulez cette facture cela va provoquer l'annulation' automatique de son bon de commande ainsi que de ses réceptions. Voulez vous vraiment annuler cette facture ?
                                        @endif
                                        @if ($bill->state =="Ouverte" OR $bill->state=="Payé" OR $bill->state=="brouillon")
                                            Vous ne pouvez pas annuler cette facture. Pour pouvoir annuler cette facture vous devez d'abord annuler la commande.
                                        @endif
                                    </div>
                                    <div class="modal-footer" style="coloer:red">
                                        @if ($bill->state=="En échéance")
                                        <form action="/bills/{{ $bill['id'] ?? ''}}" method='post'>
                                            @method('delete')
                                            @csrf
                                        <a href="{{ route('bill.cancel',['id'=>$bill->id]) }}" class="swal2-cancel swal2-styled" aria-label style="display: inline-block; background-color: rgb(221, 51, 51);"
                                            type="submit" class="btn btn-warning">
                                                    Confirmer l'annulation
                                        </a>
                                        </form>
                                        <button class="swal2-confirm swal2-styled"
                                        style="display: inline-block; background-color: rgb(48, 133, 214); border-left-color: rgb(48, 133, 214); border-right-color: rgb(48, 133, 214);"
                                        type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Fermer</button>
                                        @endif
                                        @if ($bill->state =="Ouverte" OR $bill->state=="Payé" OR $bill->state=="brouillon")
                                        <form>
                                            <button class="swal2-confirm swal2-styled"
                                            style="display: inline-block; background-color: rgb(48, 133, 214); border-left-color: rgb(48, 133, 214); border-right-color: rgb(48, 133, 214);"
                                            type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Fermer</button>
                                            </form>
                                        @endif
                                    </div>
                                    </div>
                                </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-4">

                            <button type="button" class="btn btn-raised btn-info btn-sm" style="float:right;background:#4caf50"> @if($bill->state=="brouillon")
                            {{ "Brouillon"}}
                            @else
                            {{ $bill->state }}
                            @endif
                        </button>
                        </div>
                      </div>
                    <fieldset>
                    <div class="container-fluid">
                        <div class="form-row">
                           <div class="form-group col-md-4 mt-4">
                                <span class="roboto-medium">Numéro facture :</span>
                                <span>{{ $bill->name }}</span>
                            </div>
                            <div class="form-group col-md-4 mt-4">
                                <span class="roboto-medium">Date facture:</span>
                                <span>{{ $bill->date }}</span>
                            </div>
                            <div class="form-group col-md-4 mt-4">
                                <span class="roboto-medium">Document d'origine:</span>
                                <span>{{ $bill->purchase_order->name }}</span>
                            </div>
                        </div>
                        <div class="form-row">
                           <div class="form-group col-md-4 mt-3"  data-toggle="modal" data-target="#exampleModalF">
                                <span class="roboto-medium">Fournisseur :</span>
                                <span>
                                @foreach($tiers as $tier)
                                  @if ($bill->tier_id == $tier->id)
                                     {{$tier->name}}
                                    @endif
                                @endforeach
                                </span>
                            </div>
                            <div class="form-group col-md-4 mt-3">
                                <span class="roboto-medium">Liste de prix :</span>
                            <span>{{ $bill->purchase_order->list_price->name }}</span>
                            </div>
                            <div class="form-group col-md-4 mt-3">
                                <span class="roboto-medium">Date  d'écheance :</span>
                            <span>{{ $bill->date_due }}</span>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-dark table-sm ">
                                <thead>
                                    <tr class="text-center roboto-medium">
                                        <th>Article</th>
                                        <th>Code</th>
                                        <th>Prix</th>
                                        <th>Quantité</th>
                                        <th>Taxe</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($bill->invoice_lines as $bill_line)
                                    <tr class="text-center" data-toggle="modal" data-target="#exampleModalP{{$bill_line['id']}}">
                                        <td>
                                        {{ $bill_line->product->name}}
                                        </td>
                                        <td>
                                        {{ $bill_line->product->ref}}
                                        </td>
                                        <td>
                                        {{ $bill_line->price_unit}}
                                        </td>
                                        <td>
                                            {{$bill_line->product_qty}}
                                        </td>
                                        <td>
                                            {{ $bill_line->taxe->name ?? "Aucune taxe"}}
                                        </td>
                                        <td>
                                            {{ $bill_line->amount }}
                                        </td>
                                        <!-- Modal -->
                                        <div class="modal fade bd-example-modal-sm" id="exampleModalP{{$bill_line['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalP{{$bill_line['id']}}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h2 class="swal2-title" id="swal2-title" style="display: flex;">Produit : {{$bill_line->product->name ?? ''}}</h2>
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
                                                                        <label for="inputName"> <strong> {{$bill_line->product->ref}}</strong></label>
                                                                        </div>
                                                                        <div class="md-form col-md-4 mt-4">
                                                                        <label for="inputRef">Stock virtuel :</label>
                                                                        <label for="inputName"> <strong> {{$bill_line->product->virtual_stock}}</strong></label>
                                                                        </div>
                                                                        <div class="md-form col-md-4 mt-4">
                                                                        <label for="inputRef">Stock physique :</label>
                                                                        <label for="inputName"> <strong> {{$bill_line->product->physical_stock}}</strong></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="md-form col-md-3 mt-4">
                                                                        <label for="inputSale_price">Prix de vente :</label>
                                                                        <label for="inputName"> <strong> {{$bill_line->product->sale_price}}</strong></label>
                                                                        </div>
                                                                        <div class="md-form col-md-3 mt-4">
                                                                        <label for="inputStandard_price">Prix d'achat :</label>
                                                                        <label for="inputName"> <strong> {{$bill_line->product->standard_price}}</strong></label>
                                                                        </div>
                                                                        <div class="md-form col-md-3 mt-4">
                                                                        <label for="inputStock_alerte">Stock alerte :</label>
                                                                        <label for="inputName"> <strong> {{$bill_line->product->alerte_stock}}</strong></label>
                                                                        </div>
                                                                        <div class="md-form col-md-3 mt-4">
                                                                        <label for="inputStock_alerte">Stock optimal :</label>
                                                                        <label for="inputName"> <strong> {{$bill_line->product->optimal_stock}}</strong></label>
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
                                                                        <label for="inputName"> <strong>{{$bill_line->product->warehouse->name}}</strong></label>
                                                                        </div>
                                                                        <div class="form-group col-md-4 mt-4">
                                                                        <label for="inputProcurement">Approvisionnement :</label>
                                                                        <label for="inputName"> <strong> {{$bill_line->product->procurement_method}} </strong></label>
                                                                        </div>
                                                                        <div class="form-group col-md-4 mt-4">
                                                                        <label for="inputType">Type :</label>
                                                                        <label for="inputName"> <strong> {{$bill_line->product->type}} </strong></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-4">
                                                                        <label for="inputTaxe">Taxe par défaut :</label>
                                                                        <label for="inputName"> <strong> 
                                                                        @foreach($Taxes as $taxe)
                                                                            @if($bill_line->product->taxe_id == $taxe->id)
                                                                            {{ $taxe->name }}
                                                                            @endif
                                                                        @endforeach
                                                                        </strong></label>
                                                                        </div>
                                                                        <div class="form-group col-md-4">
                                                                        <label for="inputCategory_product">Catégorie du produit :</label>
                                                                        <label for="inputName"> <strong> 
                                                                        @foreach($Category_products as $category_product)
                                                                            @if($bill_line->product->category_product_id == $category_product->id)
                                                                            {{ $category_product->name }}
                                                                            @endif
                                                                        @endforeach
                                                                        </strong></label>
                                                                        </div>
                                                                        <div class="form-group col-md-4">
                                                                        <label for="inputProduct_unities"> Unité du produit :</label>
                                                                        <label for="inputName"> <strong>
                                                                        @foreach($Product_unities as $product_unity)
                                                                        @if($bill_line->product->unity_id == $product_unity->id)
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
                                    <td>{{ $bill->ammount_ht }} {{ $bill->currency->symbole }}</td>
                                    </tr>
                                    <tr class="text-center" >
                                        <td>Total taxes :</td>
                                        <td>{{ $bill->ammount_tax }} {{ $bill->currency->symbole }}</td>
                                    </tr>
                                    <tr class="text-center" >
                                        <td>Total remises :</td>
                                        <td>{{ $bill->remise }} {{ $bill->currency->symbole }}</td>
                                    </tr>
                                    <tr class="text-center" >
                                        <td>Total :</td>
                                        <td>{{ $bill->ammount_total }} {{ $bill->currency->symbole }}</td>
                                    </tr>
                                    @if ($bill->state!="brouillon")
                                    <tr class="text-center" >
                                        <td>Balance :</td>
                                        <td><?php $balance=$bill->ammount_total;
                                                    foreach($bill->vouchers as $line){
                                                        $balance -=$line->total;
                                                    } ?>
                                                    {{ $balance }} {{ $bill->currency->symbole }}</td>
                                    </tr>
                                    @endif

                                </tbody>
                            </table>
                                     <!-- Modal Fournisseur -->
                                     <div class="modal fade bd-example-modal-sm" id="exampleModalF" tabindex="-1" role="dialog" aria-labelledby="exampleModalF" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h2 class="swal2-title" id="swal2-title" style="display: flex;">Fournisseur : {{$bill->tier->name}}</h2>
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
                                                                    <label for="inputName"> <strong> {{$bill->tier->name}}</strong></label>
                                                                    </div>
                                                                    <div class="md-form  col-md-6 mt-4">
                                                                    <label for="inputCode">Code :</label>
                                                                    <label for="inputName"> <strong> {{$bill->tier->code}}</strong></label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row">
                                                                    <div class="md-form col-md-4 mt-4">
                                                                    <label for="inputPays">Pays :</label>
                                                                    <label for="inputName"> <strong> {{$bill->tier->pays ?? 'Non renseigner'}}</strong></label>
                                                                    </div>
                                                                    <div class="md-form col-md-4 mt-4">
                                                                    <label for="inputAdresse">Adresse :</label>
                                                                    <label for="inputName"> <strong> {{$bill->tier->adresse ?? 'Non renseigner'}}</strong></label>
                                                                    </div>
                                                                    <div class="md-form  col-md-4 mt-4">
                                                                    <label for="inputCodeP">Code postal :</label>
                                                                    <label for="inputName"> <strong> {{$bill->tier->code_postal}}</strong></label>
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
                                                                    <label for="inputName"> <strong> {{$bill->tier->phone}}</strong></label>
                                                                    </div>
                                                                    <div class="md-form col-md-4 mt-4">
                                                                    <label for="inputEmail" data-error="wrong" data-success="right">Email  :</label>
                                                                    <label for="inputName"> <strong> {{$bill->tier->Email}}</strong></label>
                                                                    </div>
                                                                    <div class="md-form col-md-4 mt-4">
                                                                    <label for="inputWeb">Site web :</label>
                                                                    <label for="inputName"> <strong> {{$bill->tier->web ?? 'Non renseigner'}}</strong></label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-6 mt-4">
                                                                    <label for="inputList_prices_id">Liste de prix :</label>
                                                                    <label for="inputName">
                                                                    <strong>
                                                                    @foreach($list_prices as $list_price)
                                                                        @if($bill->tier->list_price_id == $list_price->id)
                                                                        {{ $list_price->name }}
                                                                        @endif
                                                                    @endforeach
                                                                    </strong></label>
                                                                </div>
                                                                <div class="md-form col-md-6 mt-4">
                                                                    <label for="delai">Délai de livraison : </label>
                                                                    <label for="delai"> <strong> {{$bill->tier->delai ." Jours"}} </strong></label>
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
                        </div>
                     </div>
                  </fieldset>
                  <p class="text-center" style="margin-top: 40px;">
                      <a target="_blank" href='/bills/{{$bill->id}}/pdf' class="btn btn-raised btn-info btn-sm" ><i class="fas fa-file-pdf"></i> &nbsp; IMPRIMER</a>
                  </p>
             </form>
           	</div>
        </section>
</main>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        @livewire('voucher')
      </div>
    </div>
  </div>

@endsection
@section('jsnagh')
    <script>$(document).ready(function() {
            var id=<?php  echo json_encode($bill->id); ?>;
            var lien=<?php  echo json_encode($bill->name); ?>;
            var url="/Fature/"+id;
            $('.breadcrumb-item').removeClass('active');
            $('.breadcrumb').append('<a class="breadcrumb-item active" href='+url+' >'+lien+'</a>');
            });</script>
@endsection
