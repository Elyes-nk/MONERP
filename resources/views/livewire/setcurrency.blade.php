<div>
                  <!--CONTENT-->
                  <div class="container-fluid">
                      <form  class="form-neon" wire:submit.prevent="adddevis" >
                          <legend class="col mt-2"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Demande d'achat</legend>
                          @csrf
                          <fieldset>
                              <div class="container-fluid">
                                  <div class="form-row">
                                      <div class="col col-md-4">
                                          <label for="name">N°</label>
                                          <input type="text" class="form-control mb-4" name="nameame"  placeholder="Numéro de devis" value="{{ old('inputName') }}" readonly>
                                      </div>
                                      <div class="md-form col-md-4">
                                      <label for="date">Date</label>
                                      <input type="date" class="form-control" name="date" wire:model.lazy="date" value="{{ old('date') ?? date('Y-m-d') }}"
                                      @error('date')
                                      style="border:solid 1px red "
                                      @enderror>
                                      </div>
                                      <div class="col col-md-4">
                                        <label for="tier">Condition de règlement</label>
                                        <select  class="form-control" wire:model.lazy="reglement"
                                        @error('reglement')
                                        style="border:solid 1px red "
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
                                  <div class="form-row">
                                      <div class="md-form col-md-4 mt-2" wire:ignore>
                                          <label for="tier">Fournisseur</label>
                                          <select class="form-control js-example-basic-multiple"

                                            name="fournisseur"
                                            id="tier_search"
                                          @error('name')
                                          style="border:solid 1px red "
                                          @enderror required style="color:black">
                                            <option value="">Sélectionner un fournisseur</option>
                                              @forelse($tiers as $tier)
                                                  <option value="{{ $tier->id }}"
                                                      @if( old('tier') == $tier->id)
                                                          {{ 'selected' }}
                                                          @endif >
                                                          {{ $tier->name }}
                                                        </option>
                                              @empty
                                                  <option value=''>Aucun fournisseur </option>
                                              @endforelse
                                          </select>
                                      </div>
                                      <script>

                                    </script>
                                    <input type="hidden" id="list_supplier" value="{{$pricelist}}">
                                      <div id="list_price_search" class="md-form col-md-4 mt-2" wire:ignore>

                                        <label  for="listprice">Liste de prix</label>
                                        <select class="js-example-basic-multiple form-control"
                                             id="list_search"
                                        required
                                         @error('pricelist')
                                         style="border:solid 1px red "
                                        @enderror >
                                            <option value="">Sélectionner une liste de prix</option>

                                            @forelse($listprices as $listprice)
                                                <option value="{{ $listprice->id }}"
                                                    @if(($listprice->id==$pricelist)||(old('listprice')==$listprice->id))
                                                        {{"selected"}}
                                                        @endif>{{ $listprice->name }}</option>
                                            @empty
                                                <option value=''>Aucune liste de prix </option>
                                            @endforelse
                                        </select>
                                      </div>
                                      <div class="md-form col-md-4 mt-2">
                                          <label for="dateshippement">Date prévue de livraison</label>
                                          <input type="date" class="form-control" name="dateshippement" placeholder="Date prévue de livrason" wire:model.lazy="dateship" value="{{  old('dateship') ?? $dateship  }}" @error('dateship')
                                          style="border:solid 1px red "
                                          @enderror>
                                      </div>
                                    </div>
                              </div>
                          </fieldset>

                              <legend class="col mt-5"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Lignes de commande</legend>
                              <div class="container-fluid">
                                  <div class="table-responsive" >
                                  <input type="hidden" id="product_warehouse" value="{{ $product_warehouse }}">
                                  <input type="hidden" id="product_taxe" value="{{ $product_taxe }}">
                                  <input type="hidden" id="intz" value="{{ $intz }}">
                                  <input type="hidden" id="product_product" value="{{ $product }}">
                                      <table id="matable" class="table table-dark table-sm ">

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
                                                  <th>Modifier</th>
                                                  <th>Ajouter/Supprimer</th>
                                              </tr>
                                          </thead>
                                          <tbody>

                                            @foreach ($lignes as $ligne)

                                            <tr class="text-center">
                                                <td>
                                                {{ $ligne['product'] }}
                                                </td>
                                                <td>
                                                    {{ $ligne['code'] }}
                                                </td>
                                                <td>
                                                         {{ $ligne['unit'] }}
                                                </td>
                                                <td>
                                                     {{ $ligne['qty'] }}
                                                </td>
                                                <td>

                                                    {{ $ligne['price'] }}
                                                </td>
                                                <td>

                                                    {{ $ligne['taxe'] ?? "Aucune taxe" }}
                                                </td>
                                                <td>

                                                    {{ $ligne['warehouse'] }}
                                                </td>
                                                <td>
                                                    {{ $ligne['subtotal'] }}
                                                </td>
                                                <td>
                                                    <a href="#" wire:click="modifyline({{ $ligne['index']}})" class="btn btn-success">
                                                        <i class="fas fa-sync-alt" ></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a data-toggle="modal" data-target="#exampleModal{{$ligne['index']}}" class="btn btn-danger">
                                                        <i class="far fa-trash-alt"></i>
                                                    </a>
                                                    <!-- Modal -->
                                                    <div class="modal fade bd-example-modal-sm" id="exampleModal{{$ligne['index']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModal{{$ligne['index']}}" aria-hidden="true">
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
                                                            <a   wire:click="deleteline({{ $ligne['index']}})" class="swal2-cancel swal2-styled" aria-label style="display: inline-block;color:white ;background-color: rgb(221, 51, 51);"
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
                                            <tr class="text-center">
                                                <td style="width:150px">
                                                    <div wire:ignore id="item1">
                                                    <select   class="js-example-basic-multiple form-control"
                                                     id="product_search"
                                                    @error('product')
                                                    style="border:solid 1px red"
                                                    @enderror
                                                     >

                                                        <option value="">Sélectionner un produit</option>
                                                    @forelse($produits as $produit)
                                                        <option value="{{ $produit->id }}"
                                                            >{{ $produit->name }}</option>
                                                    @empty
                                                        <option value=''>Aucun article </option>
                                                    @endforelse
                                                    </select>
                                                </div>
                                                </td>
                                                <td>
                                                    @if ($product_code !="")
                                                    <input type="text" class="form-control mb-4" name="code" wire:model="product_code" @error('product_code')
                                                    style="border:solid 1px red"
                                                    @enderror  placeholder="Code article" value="{{ $product_code }}" >
                                                    @else
                                                    <input type="text" class="form-control mb-4" name="code"  placeholder="Code article" @error('product_code')
                                                    style="border:solid 1px red"
                                                    @enderror wire:model="product_code"
                                                     >
                                                    @endif
                                                </td>
                                                <td>
                                                    <select name="unit"  class="form-control"
                                                    @error('product_unit')
                                                    style="border:solid 1px red"
                                                    @enderror
                                                    wire:model.lazy="product_unit" readonly>
                                                        <option value="" >Selectionner une unité </option>
                                                        @forelse($units as $unit)
                                                            <option value="{{ $unit->id }}"
                                                                @if ($unit->id==$product_unit)
                                                                    {{ 'selected'}}
                                                                @endif
                                                                >{{ $unit->name }}</option>
                                                        @empty
                                                            <option value=''>Aucune unité d'article </option>
                                                        @endforelse
                                                        </select>
                                                </td>
                                                <td >
                                                    @if ($product_qty !="")
                                                    <input type="text" class="form-control mb-4" name="qty" @error('product_qty')
                                                    style="border:solid 1px red"
                                                    @enderror wire:model="product_qty" placeholder="Quantité"

                                                        value="{{ $product_qty }}"
                                                     >
                                                     @else
                                                     <input type="text" class="form-control mb-4" name="qty"@error('product_qty')
                                                     style="border:solid 1px red"
                                                     @enderror wire:model="product_qty" placeholder="Quantité"

                                                        value="{{ 0 }}"
                                                     >
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($product_price !="")
                                                    <input type="text" class="form-control mb-4" name="price"  placeholder="Prix" @error('product_price')
                                                    style="border:solid 1px red"
                                                    @enderror wire:model="product_price"

                                                        value="{{ $product_price }}"
                                                     >
                                                     @else
                                                     <input type="text" class="form-control mb-4" name="price"  placeholder="Prix" wire:model="product_price" value="{{ 0 }}">
                                                    @endif
                                                </td>
                                                <td >
                                                    <div wire:ignore id="item2">
                                                    <select  class="js-example-basic-multiple form-control"
                                                     id="taxe_search"
                                                    >
                                                        <option value="" disabaled>Sélectionner la taxe </option>
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
                                                <td >
                                                    <div wire:ignore id="item3">
                                                    <select name="warehouse"
                                                     id="entrepot_search" class="js-example-basic-multiple form-control"
                                                    @error('product_warehouse')
                                                    style="border:solid 1px red"
                                                    @enderror >

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
                                                <td>
                                                    @if ($subtotal != "")
                                                    <input type="number" class="form-control mb-4" name="total"  placeholder="Total"  value="{{ $subtotal }}" readonly>
                                                    @else
                                                    <input type="number" class="form-control mb-4" name="total"  placeholder="Total" value="{{ 0 }}" readonly>
                                                    @endif
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
                          </div>
                          <fieldset>
                          <div class="table-responsive">
                              <table class="table table-dark table-sm pl-50">
                                  <tbody>
                                      <tr class="text-center" >
                                          <td>Total hors taxe :</td>
                                          <td>{{ $amount_untaxed }} {{ $currency }} </td>
                                      </tr>
                                      <tr class="text-center" >
                                          <td>Total taxes :</td>
                                          <td>{{ $amount_tax }} {{ $currency }}</td>
                                      </tr>
                                      <tr class="text-center" >
                                        <td>Total remises :</td>
                                        <td>{{ $remise }} {{ $currency }}</td>
                                    </tr>
                                      <tr class="text-center" >
                                          <td>Total :</td>
                                      <td>{{$amount}} {{ $currency }}</td>
                                      </tr>
                                  </tbody>
                              </table>
                          </div>
                        </fieldset>
                          <p class="text-center" style="margin-top: 40px;">
                              <button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; ENREGISTRER</button>
                          </p>
                      </form>
                  </div>
</div>

@section('jsnagh')
<script>


    $(document).ready(function() {

        var lien= <?php  echo json_encode("Nouveau"); ?>;
    var url="/devis/create";
    $('.breadcrumb-item').removeClass('active');
    $('.breadcrumb').append('<a class="breadcrumb-item active" href='+url+' >'+lien+'</a>');

        var fin=1;
        var fip=1;
        var init=1;
        var fix=1;
        var fiw=2;
        $('.js-example-basic-multiple').select2();
        $('#tier_search').on('change', function (e) {
            @this.set('name', e.target.value);

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
    fiw=0;
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
<!--<script>
document.getElementById("tier_search").addEventListener("change", change);
function change() {

l="Sélectionner une liste de prix";
var lpp=<?php echo json_encode($listprices); ?>;
var lp=<?php echo json_encode($pricelist); ?>;
    for(var i=0; i<lpp.length;i++){
        console.log(lpp[i].id);
        if(lp=lpp[i].id){
            l=lpp[i].name;
            break;
        }

    }

var c=document.getElementById('list_price_search').childNodes;
        var testContainer = document.querySelector('#list_price_search');
        var n = testContainer.querySelector('.filter-option-inner');
        var clss=n.className;

        console.log(l);
        n.innerHTML=l;
    };
setInterval(function(){


    }, 1000);
    $(document).ready(function(){


      $('#tier_search').selectpicker();
      $('#list_search').selectpicker();
      $('#product_search').selectpicker();
      $('#taxe_search').selectpicker();
      $('#entrepot_search').selectpicker();
    });
      </script> -->
@foreach($lignes as $ligne)
<script>

$("#exampleModal{{$ligne['index']}}").on('shown.bs.modal', function () {
  $("#myInput{{$ligne['index']}}").trigger('focus')
})
</script>
@endforeach
@endsection
