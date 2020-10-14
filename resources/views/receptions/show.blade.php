
    @extends('layouts.base')
    @section("custom_style")
    <style>
    @media (min-width:576px)
    {.modal-dialog{max-width:90%;margin:1.75rem auto}
}
</style>
@endsection
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
                    <i class="fas fa-clipboard-check fa-fw"></i> &nbsp;VOTRE BON DE RECEPTION
                </h3>
                @include('receptions.breadcumb')
            </div>
            <div class="container-fluid">
                <ul class="full-box list-unstyled page-nav-tabs">
                       <a href="{{ route('receptions.show',["reception"=>$id_previous->id]) }}" class="btn btn-raised btn btn" ><i class="fas fa-chevron-left"></i></a>
                    <li>
                        <a href="{{route('receptions.index')}}"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTE DES RECEPTIONS</a>
                    </li>
                        <a href="{{ route('receptions.show',["reception"=>$id_next->id ]) }}" class="btn btn-raised btn btn" ><i class="fas fa-chevron-right"></i></a>
                </ul>
            </div>
            <!--CONTENT-->
            <div class="container-fluid">
            <form class="form-neon" autocomplete="off">
                <div class="row justify-content-between">
                    <div class="col-6">
                        @if (Auth::user()->role!="Financier")
                        @if ($reception->state=="Reçu")
                        <button type="button" data-toggle="modal" data-target="#ModalCenterRetour"  class="btn btn-raised btn-info btn-sm"  >Retourner les articles</button>

                        @endif
                        @if($reception->state=="assigned")
                        <a href="#" data-toggle="modal" data-target="#exampleModalCenter"  class="btn btn-raised btn-info btn-sm"  >Réception des articles</a>
                        @endif
                        @if ($reception->state!="Annulé")
                        <button type="button"  class="btn btn-raised btn-info btn-sm" data-target="#exampleModal" data-toggle="modal" >Annuler la réception</button>

                                <!-- Modal -->
                                <div class="modal fade bd-example-modal-sm" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal{{$reception->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document" style="max-width:50%">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h2 class="swal2-title" id="swal2-title" style="display: flex;">Réception : {{$reception->name}}</h2>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Voulez-vous vraiment annuler cette réception?
                                    </div>
                                    <div class="modal-footer">
                                            <a href="{{route('cancel.receipt',['id'=>$reception->id])}}" class="swal2-cancel swal2-styled" aria-label style="display: inline-block; background-color: rgb(221, 51, 51);"
                                             class="btn btn-warning">
                                                    Confirmer l'annulation
                                    </a>
                                        <button class="swal2-confirm swal2-styled"
                                        style="display: inline-block; background-color: rgb(48, 133, 214); border-left-color: rgb(48, 133, 214); border-right-color: rgb(48, 133, 214);"
                                        type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Fermer</button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                @endif
                        @endif
                        </div>
                    <div class="col-4">
                        <button type="button" class="btn btn-raised btn-info btn-sm" style="float:right;background:#4caf50"> @if($reception->state=="assigned")
                        {{ "Pret à recevoir"}}
                        @else
                        {{ $reception->state }}
                        @endif
                    </button>
                    </div>
                  </div>
                    <fieldset>
                    <div class="container-fluid">
                        <div class="form-row">
                           <div class="form-group col-md-6 mt-4">
                                <span class="roboto-medium">Nom :</span>
                                <span>{{ $reception->name }}</span>
                            </div>
                            <div class="form-group col-md-6 mt-4">
                                <span class="roboto-medium">Date :</span>
                                <span>{{ $reception->date }}</span>
                            </div>
                        </div>
                        <div class="form-row">
                           <div class="form-group col-md-6 mt-4" data-toggle="modal" data-target="#exampleModalF">
                                <span class="roboto-medium">Fournisseur :</span>
                                <span>
                                {{$reception->tier->name}}
                                </span>
                            </div>
                            <div class="form-group col-md-6 mt-4">
                                <span class="roboto-medium">Document d'origine :</span>
                                <span>
                                {{$reception->purchase_order->name}}
                                </span>
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
                                        <th>Entrepôt de stockage</th>
                                    </tr>
                                </thead>
                                 <tbody>
                                    @foreach($reception->reception_lines as $line)
                                    <tr class="text-center" data-toggle="modal" data-target="#exampleModalP{{$line['id']}}">
                                        <td>
                                            {{ $line->product->name }}
                                        </td>
                                        <td>
                                            {{ $line->product->ref }}
                                        </td>
                                        <td>
                                            {{ $line->product->unity->name }}
                                        </td>
                                        <td>
                                            {{ $line->product_qty }}
                                        </td>
                                        <td>
                                            {{ $line->warehouse->name}}
                                        </td>
                                        <!-- Modal -->
                                        <div class="modal fade bd-example-modal-sm" id="exampleModalP{{$line['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalP{{$line['id']}}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h2 class="swal2-title" id="swal2-title" style="display: flex;">Produit : {{$line->product->name ?? ''}}</h2>
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
                                                                        <label for="inputName"> <strong> {{$line->product->ref}}</strong></label>
                                                                        </div>
                                                                        <div class="md-form col-md-4 mt-4">
                                                                        <label for="inputRef">Stock virtuel :</label>
                                                                        <label for="inputName"> <strong> {{$line->product->virtual_stock}}</strong></label>
                                                                        </div>
                                                                        <div class="md-form col-md-4 mt-4">
                                                                        <label for="inputRef">Stock physique :</label>
                                                                        <label for="inputName"> <strong> {{$line->product->physical_stock}}</strong></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="md-form col-md-3 mt-4">
                                                                        <label for="inputSale_price">Prix de vente :</label>
                                                                        <label for="inputName"> <strong> {{$line->product->sale_price}}</strong></label>
                                                                        </div>
                                                                        <div class="md-form col-md-3 mt-4">
                                                                        <label for="inputStandard_price">Prix d'achat :</label>
                                                                        <label for="inputName"> <strong> {{$line->product->standard_price}}</strong></label>
                                                                        </div>
                                                                        <div class="md-form col-md-3 mt-4">
                                                                        <label for="inputStock_alerte">Stock alerte :</label>
                                                                        <label for="inputName"> <strong> {{$line->product->alerte_stock}}</strong></label>
                                                                        </div>
                                                                        <div class="md-form col-md-3 mt-4">
                                                                        <label for="inputStock_alerte">Stock optimal :</label>
                                                                        <label for="inputName"> <strong> {{$line->product->optimal_stock}}</strong></label>
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
                                                                        <label for="inputName"> <strong>{{$line->product->warehouse->name}}</strong></label>
                                                                        </div>
                                                                        <div class="form-group col-md-4 mt-4">
                                                                        <label for="inputProcurement">Approvisionnement :</label>
                                                                        <label for="inputName"> <strong> {{$line->product->procurement_method}} </strong></label>
                                                                        </div>
                                                                        <div class="form-group col-md-4 mt-4">
                                                                        <label for="inputType">Type :</label>
                                                                        <label for="inputName"> <strong> {{$line->product->type}} </strong></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-4">
                                                                        <label for="inputTaxe">Taxe par défaut :</label>
                                                                        <label for="inputName"> <strong> 
                                                                        @foreach($Taxes as $taxe)
                                                                            @if($line->product->taxe_id == $taxe->id)
                                                                            {{ $taxe->name }}
                                                                            @endif
                                                                        @endforeach
                                                                        </strong></label>
                                                                        </div>
                                                                        <div class="form-group col-md-4">
                                                                        <label for="inputCategory_product">Catégorie du produit :</label>
                                                                        <label for="inputName"> <strong> 
                                                                        @foreach($Category_products as $category_product)
                                                                            @if($line->product->category_product_id == $category_product->id)
                                                                            {{ $category_product->name }}
                                                                            @endif
                                                                        @endforeach
                                                                        </strong></label>
                                                                        </div>
                                                                        <div class="form-group col-md-4">
                                                                        <label for="inputProduct_unities"> Unité du produit :</label>
                                                                        <label for="inputName"> <strong>
                                                                        @foreach($Product_unities as $product_unity)
                                                                        @if($line->product->unity_id == $product_unity->id)
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
                            
                                     <!-- Modal Fournisseur -->
                                     <div class="modal fade bd-example-modal-sm" id="exampleModalF" tabindex="-1" role="dialog" aria-labelledby="exampleModalF" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h2 class="swal2-title" id="swal2-title" style="display: flex;">Fournisseur : {{$reception->tier->name}}</h2>
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
                                                                    <label for="inputName"> <strong> {{$reception->tier->name}}</strong></label>
                                                                    </div>
                                                                    <div class="md-form  col-md-6 mt-4">
                                                                    <label for="inputCode">Code :</label>
                                                                    <label for="inputName"> <strong> {{$reception->tier->code}}</strong></label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row">
                                                                    <div class="md-form col-md-4 mt-4">
                                                                    <label for="inputPays">Pays :</label>
                                                                    <label for="inputName"> <strong> {{$reception->tier->pays ?? 'Non renseigner'}}</strong></label>
                                                                    </div>
                                                                    <div class="md-form col-md-4 mt-4">
                                                                    <label for="inputAdresse">Adresse :</label>
                                                                    <label for="inputName"> <strong> {{$reception->tier->adresse ?? 'Non renseigner'}}</strong></label>
                                                                    </div>
                                                                    <div class="md-form  col-md-4 mt-4">
                                                                    <label for="inputCodeP">Code postal :</label>
                                                                    <label for="inputName"> <strong> {{$reception->tier->code_postal}}</strong></label>
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
                                                                    <label for="inputName"> <strong> {{$reception->tier->phone}}</strong></label>
                                                                    </div>
                                                                    <div class="md-form col-md-4 mt-4">
                                                                    <label for="inputEmail" data-error="wrong" data-success="right">Email  :</label>
                                                                    <label for="inputName"> <strong> {{$reception->tier->Email}}</strong></label>
                                                                    </div>
                                                                    <div class="md-form col-md-4 mt-4">
                                                                    <label for="inputWeb">Site web :</label>
                                                                    <label for="inputName"> <strong> {{$reception->tier->web ?? 'Non renseigner'}}</strong></label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-6 mt-4">
                                                                    <label for="inputList_prices_id">Liste de prix :</label>
                                                                    <label for="inputName">
                                                                    <strong>
                                                                    @foreach($list_prices as $list_price)
                                                                        @if($reception->tier->list_price_id == $list_price->id)
                                                                        {{ $list_price->name }}
                                                                        @endif
                                                                    @endforeach
                                                                    </strong></label>
                                                                </div>
                                                                <div class="md-form col-md-6 mt-4">
                                                                    <label for="delai">Délai de livraison : </label>
                                                                    <label for="delai"> <strong> {{$reception->tier->delai ." Jours"}} </strong></label>
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
                    <a target="_blank" href='/receptions/{{$reception->id}}/pdf' class="btn btn-raised btn-info btn-sm" ><i class="fas fa-file-pdf"></i> &nbsp; IMPRIMER</a>
                  </p>
             </form>
           	</div>
        </section>
</main>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        @livewire('validate-qty')
      </div>
    </div>
  </div>

  </div>
  <div class="modal fade" id="ModalCenterRetour" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitleRetour" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        @livewire('validate-qty')

      </div>
    </div>
  </div>


@endsection
@section('jsnagh')
<script>
$(document).ready(function() {
            var id=<?php  echo json_encode($reception->id); ?>;
            var lien=<?php  echo json_encode($reception->name); ?>;
            var url="/receptions/"+id;
            $('.breadcrumb-item').removeClass('active');
            $('.breadcrumb').append('<a class="breadcrumb-item active" href='+url+' >'+lien+'</a>');
            });
</script>


@endsection

















