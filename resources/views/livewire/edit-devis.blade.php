<div>
    <!--CONTENT-->
    <div class="container-fluid">
        <form class="form-neon" autocomplete="off" wire:submit.prevent="updatedevis" method='post'>
                @csrf
                @method('PUT')
                <fieldset>
                <div class="container-fluid">


                    <div class="form-row">
                       <div class="form-group col-md-4 " style="padding-top:0px">
                            <span class="roboto-medium">N° :</span>

                            <input type="text"   class="form-control mb-4" value="{{  $purchase_order->name}}" readonly>
                        </div>
                        <div class="form-group col-md-4 " style="padding-top:0px"

                        >
                            <span class="roboto-medium">Date :</span>
                            <input type="date" class="form-control" wire:model="date" placeholder="Date" value="{{ $purchase_order->date  }}"
                            @error('date')
                             style="border:solid 1px red"
                            @enderror>
                            @error('inputDate')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col col-md-4">
                            <label for="tier">Condition de règlement</label>
                            <select  class="form-control" wire:model.lazy="reglement" @error('reglement')
                            style="broder: 1px solid red "
                            @enderror required>
                                <option value="" selected >Selectionner une condition de reglement</option>

                                    <option value="15" @if ($reglement==15)
                                        {{ "selected" }}
                                    @endif>

                                            {{ "15 Jours" }}
                                          </option>
                                    <option value="30" @if ($reglement==30)
                                    {{ "selected" }}
                                @endif>

                                            {{ "30 Jours" }}
                                          </option>
                                    <option value="45"@if ($reglement==45)
                                    {{ "selected" }}
                                @endif>

                                            {{ "45 Jours" }}
                                          </option>
                            </select>
                          </div>
                    </div>
                    <div class="form-row" >

                       <div class="form-group col-md-4 "  style="padding-top:0px" wire:ignore>
                            <span class="roboto-medium">Fournisseur :</span>
                            <select name="inputTier"
                            @if($tier_id)
                             style="border:solid 1px red"
                            @endif
                            class="form-control js-example-basic-multiple" id="tier_search">
                                <option value='' >Sélectionnez un fournisseur </option>
                                @forelse($tiers as $tier)
                                    <option value="{{ $tier->id }}"
                                       @if ($tier_id==$tier->id)
                                            {{ 'selected' }}
                                       @endif >
                                       {{ $tier->name }}
                                    </option>
                                @empty
                                    <option value=''>Aucun fournisseur </option>
                                @endforelse
                            </select>

                        </div>

                        <div class="form-group col-md-4 " style="padding-top:0px" wire:ignore>
                             <span class="roboto-medium">Liste de prix :</span>

                             <select id="list_search" class="form-control js-example-basic-multiple"
                             @error('pricelist')
                             style="border:solid 1px red"
                            @enderror
                             >
                                <option value='' disabled>Sélectionnez une liste de prix </option>
                                 @forelse($listprices as $listprice)
                                     <option value="{{ $listprice->id }}"
                                        @if ($pricelist==$listprice->id)
                                             {{ 'selected' }}
                                        @endif >
                                        {{ $listprice->name }}
                                     </option>
                                 @empty
                                     <option value=''>Aucune liste de prix </option>
                                 @endforelse
                             </select>

                         </div>
                        <div class="form-group col-md-4 " style="padding-top:0px">
                            <span class="roboto-medium">Date pévue de livraison:</span>
                            <input type="date" class="form-control" wire:model.lazy="date_ship" placeholder="Date prévue de livraison" value="{{ $purchase_order->date_shippement  }}"
                            @error('date_ship')
                             style="border:solid 1px red"
                            @enderror>
                            @error('date_ship')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
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
                                    <th>destination</th>
                                    <th>Total</th>
                                    <th>Modifier</th>
                                    <th>Ajouter/Supprimer</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lignes as $purchase_order_line)
                                <tr class="text-center" >
                                    <td>


                                            <input type="text" class="form-control mb-4" value="{{  $purchase_order_line->product->name }}" readonly>
                                    </td>
                                    <td>

                                        <input type="text"   class="form-control mb-4" value="{{ $purchase_order_line->product->ref}}" readonly>


                                    </td>
                                    <td>

                                        <input type="text" class="form-control mb-4"   value="{{  $purchase_order_line->product->unity->name}}" readonly>

                                    </td>
                                    <td>

                                        <input type="text"   class="form-control mb-4" value="{{  $purchase_order_line->product_qty}}" readonly>

                                    </td>
                                    <td>

                                        <input type="text" class="form-control mb-4"   value="{{ $purchase_order_line->price_unit }}" readonly>


                                    </td>
                                    <td>
                                        <input type="text" class="form-control mb-4"   value="{{ $purchase_order_line->taxe->name ?? 'Aucune taxe'}}" readonly>
                                    </td>
                                    <td>

                                        <input type="text" class="form-control mb-4"   value="{{ $purchase_order_line->warehouse->name }}" readonly>
                                    </td>
                                   <td>
                                       <input type="text" class="form-control mb-4"   value="{{ $purchase_order_line->amount }}" readonly>
                                    </td>
                                    <td>
                                        <a href="#" wire:click="modifyline({{ $purchase_order_line->id }})" class="btn btn-success">
                                            <i class="fas fa-sync-alt" ></i>
                                        </a>
                                        </td>
                                        <td>
                                        <a data-toggle="modal" data-target="#exampleModal{{$purchase_order_line->id}}" class="btn btn-danger">
                                            <i class="far fa-trash-alt"></i>
                                        </a>
                                        <!-- Modal -->
                                        <div class="modal fade bd-example-modal-sm" id="exampleModal{{$purchase_order_line->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModal{{$purchase_order_line->id}}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h2 class="swal2-title" id="swal2-title" style="display: flex;">Commande : {{$ligne['product'] ?? ''}}</h2>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Voulez-vous vraiment supprimer cette ligne?
                                            </div>
                                            <div class="modal-footer">
                                                <a   wire:click="deleteline({{ $purchase_order_line->id}})" class="swal2-cancel swal2-styled" aria-label style="display: inline-block;color:white ;background-color: rgb(221, 51, 51);"
                                                     class="btn btn-warning" data-dismiss="modal" aria-label="Close">Supprimer
                                            </a>
                                                <button class="swal2-confirm swal2-styled"
                                                style="display: inline-block; background-color: rgb(48, 133, 214); border-left-color: rgb(48, 133, 214); border-right-color: rgb(48, 133, 214);"
                                                type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Annuler
                                                </button>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                <tr class="text-center" >
                                    <td>
                                        <div wire:ignore id="item1">
                                    <select  class="form-control js-example-basic-multiple" id="product_search"
                                    @error('product')
                                    style="border:solid 1px red"
                                   @enderror>
                                        <option value='' >Selectionnez un produit</option>
                                        @forelse($produits as $produit)

                                            <option value="{{ $produit->id }}"
                                                @if ($product==$produit->id)
                                                {{ 'selected'  }}
                                            @endif >{{ $produit->name }}</option>
                                        @empty
                                            <option value=''>Aucun produit </option>
                                        @endforelse
                                    </select>
                                        </div>
                                    </td>
                                    <td>

                                        <input type="text" wire:model="product_code"  class="form-control mb-4" value="{{ $product_code}}" readonly
                                        @error('product_code')
                                            style="border:solid 1px red"
                                        @enderror>


                                    </td>
                                    <td>

                                        <input type="text" class="form-control mb-4" wire:model="product_unit"  value="{{  $product_unit }}" readonly
                                        @error('unit')
                                            style="border:solid 1px red"
                                        @enderror
                                        >

                                    </td>
                                    <td>

                                        <input type="text" wire:model="product_qty"  class="form-control mb-4" value="{{  $product_qty}}"
                                        @error('product_qty')
                                            style="border:solid 1px red"
                                        @enderror
                                        >

                                    </td>
                                    <td>

                                        <input type="text" class="form-control mb-4" wire:model="product_price"  value="{{ $product_price }}"
                                        @error('product_price')
                                                style="border:solid 1px red"
                                        @enderror
                                        >


                                    </td>
                                    <td>
                                        <div wire:ignore id="item2">
                                        <select id="taxe_search" name="taxe" class="form-control js-example-basic-multiple"  @error('product_taxe')
                                        style="border:solid 1px red"
                                       @enderror>

                                            <option value="" >Selectionner la taxe </option>
                                            @forelse($taxes as $taxe)
                                                <option value="{{ $taxe->id }}"
                                                    @if ($product_taxe==$taxe->id)
                                                        {{ 'selected' }}
                                                    @endif
                                                    >{{ $taxe->name }}</option>
                                            @empty
                                                <option value=''>Aucune taxe </option>
                                            @endforelse
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div wire:ignore id="item3">
                                        <select name="warehouse" @error('product_warehouse')
                                        style="border:solid 1px red"
                                        @enderror class="form-control js-example-basic-multiple" id="entrepot_search">

                                            <option value="" disabaled>Sélectionner un entrepôt de destination </option>
                                            @forelse($warehouses as $warehouse)
                                                <option value="{{ $warehouse->id }}"
                                                    @if($product_warehouse==$warehouse->id)
                                                    {{ 'selected'}}
                                                    @endif>{{ $warehouse->name }}</option>
                                            @empty
                                                <option value=''>Aucun entrepôt </option>
                                            @endforelse
                                            </select>
                                        </div>
                                    </td>
                                   <td> <input type="text" class="form-control mb-4"   value="{{ $subtotal  }}" readonly>
                                    </td>
                                    <td></td>
                                    <td>
                                        <a class="btn btn-primary"   wire:click="addproduct" >
                                            <div class="spinner-border" wire:loading role="status">
                                                <span class="sr-only">Loading...</span>
                                              </div>
                                              <div wire:loading.remove>
                                                <i class="fas fa-plus fa-fw" ></i> &nbsp;
                                              </div>
                                        </a>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <input type="hidden" id="product_warehouse" value="{{ $product_warehouse }}">
                    <input type="hidden" id="product_taxe" value="{{ $product_taxe }}">
                    <input type="hidden" id="intz" value="{{ $intz }}">
                    <input type="hidden" id="product_product" value="{{ $product }}">

                    <input type="hidden" id="list_supplier" value="{{$pricelist}}">
                    <div class="table-responsive">
                        <table class="table table-dark table-sm pl-50">
                            <tbody>
                                <tr class="text-center" >
                                    <td>Total hors taxe :</td>
                                <td>{{$amount_ht ?? $purchase_order->ammount_ht}} {{ $currency ?? $purchase_order->list_price->currency->symbole }}</td>
                                </tr>
                                <tr class="text-center" >
                                    <td>Total taxes :</td>
                                    <td>{{ $amount_tax ?? $purchase_order->ammount_tax}} {{ $currency ?? $purchase_order->list_price->currency->symbole }}</td>
                                </tr>
                                <tr class="text-center" >
                                    <td>Total Remises:</td>
                                    <td>{{ $remise ?? $purchase_order->remise }} {{ $currency ?? $purchase_order->list_price->currency->symbole }}</td>

                                </tr>
                                <tr class="text-center" >
                                    <td>Total :</td>
                                    <td>{{ $amount ?? $purchase_order->ammount_total }} {{ $currency ?? $purchase_order->list_price->currency->symbole }}</td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                 </div>
              </fieldset>

            <p class="text-center" style="margin-top: 40px;">
              <button type="submit" class="btn btn-raised btn-success btn-sm"><i class="fas fa-sync-alt"></i> &nbsp; ACTUALISER</button>

            </p>
         </form>
           </div>
</div>
@section('jsnagh')
<script>

    $(document).ready(function() {
        var id=<?php  echo json_encode($purchase_order->id); ?>;
        var lien=<?php  echo json_encode($purchase_order->name); ?>;
        var url="/devis/"+id;
        $('.breadcrumb-item').removeClass('active');
        $('.breadcrumb').append('<a class="breadcrumb-item active" href='+url+' >'+lien+'</a> <a class="breadcrumb-item active" href="#">edit</a>');

var fin=1;
var fip=1;
var fix=1;
var fiw=1;
$('.js-example-basic-multiple').select2();
$('#tier_search').on('change', function (e) {
    @this.set('tier_id', e.target.value);

    fin=0;

    console.log("you");
});
$('#product_search').on('change', function (e) {
    @this.set('product', e.target.value);
    fip=0;


    console.log("changed");
});
$('#taxe_search').on('change', function (e) {
    @this.set('product_taxe', e.target.value);
    fix=0;
    $('#product_taxe').val(e.target.value);

    console.log("you");
});
$('#entrepot_search').on('change', function (e) {
    @this.set('product_warehouse', e.target.value);
    fiw=0;
    $('#product_warehouse').val(e.target.value);

    console.log("you");
});
$('#list_search').on('change', function (e) {
    @this.set('pricelist', e.target.value);
    fin=0;
    $('#list_supplier').val(e.target.value);

    console.log("you");
});
setInterval(function(){

    var pr=$('#list_supplier').val();
    var tx=$('#product_taxe').val();
    var wr=$('#product_warehouse').val();
        if($('#intz').val()==0 && fiw==0 && (wr>0 || wr=="")){
            $('#entrepot_search').val(wr);
            $('#entrepot_search').select2().trigger('change');
            fiw=1;
        }
        if($('#intz').val()==0 && fix==0 && (tx>0 || tx=="")){
            $('#taxe_search').val(tx);
            $('#taxe_search').select2().trigger('change');
            fix=1;
        }
        if(fin==0 && pr>0){

        $('#list_search').val(pr);
        $('#list_search').select2().trigger('change');
            fin=1;
            console.log(fin);
        }
     if(fip==0 && wr>0 && tx>0){

            $('#entrepot_search').val(wr);
            $('#entrepot_search').select2().trigger('change');

            $('#taxe_search').val(tx);
            $('#taxe_search').select2().trigger('change');
            fip=1;

    }

    if($('#intz').val()==1){

            $('#entrepot_search').val("");
            $('#entrepot_search').select2().trigger('change');

            $('#taxe_search').val("");
            $('#taxe_search').select2().trigger('change');
            $('#product_search').val("");
            $('#product_search').select2().trigger('change');

            $('#intz').val(0);
            @this.set('intz', 0);
    }
    if($('#intz').val()==2 && $("#product_product").val()!="" && $("#product_warehouse").val()!="" ){
        $('#product_search').val($("#product_product").val());
        $('#product_search').select2().trigger('change');
        $('#entrepot_search').val($("#product_warehouse").val());
        $('#entrepot_search').select2().trigger('change');

        $('#taxe_search').val($("#product_taxe").val());
        $('#taxe_search').select2().trigger('change');


            $('#intz').val(0);
            @this.set('intz', 0);
    }

    }, 1000);
});
</script>
@endsection
