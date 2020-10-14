<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use App\Tier;
use App\ListPrice;
use App\Product;
use App\productUnity;
use App\Taxe;
use App\Warehouse;
use App\Company;
use App\PurchaseOrder;
use App\PurchaseOrderLine;
use Illuminate\Support\Collection;
use App\Sequence;
class EditDevis extends Component
{
    public $intz=0;
    public $order_id;
    public $tiers;
    public $currency;
    public $pricelist;
    public $produits;
    public $units;
    public $taxes;
    public $warehouses;
    public $purchase_order;
    public $purchase_order_lines;
    public $listprices;
    public $date;
    public $date_ship;
    public $tier_id;
    public $product;
    public $product_unit;
    public $product_code;

    public $product_qty;
    public $product_price;
    public $product_taxe;
    public $product_warehouse;
    public $subtotal;
    public $amount_ht;
    public $amount_tax;
    public $amount;
    public $lignes;
    public $lines;
    public $reglement;
    public $input_warehouse=false;
    public $input_taxe=false;
    public $input_tier=false;
    public $input_list=false;
    public $input_product=false;
    public $remise;
    public $p;
    public function mount(){
        $this->order_id=Route::current()->devi;
        $this->produits=Product::all();
        $this->units=ProductUnity::all();
        $this->taxes=Taxe::all();
        $this->warehouses=Warehouse::all();

        $this->tiers=Tier::all();
        $this->listprices=ListPrice::all();
        $this->purchase_order=PurchaseOrder::find($this->order_id);
        $this->date=$this->purchase_order->date;
        $this->date_ship=$this->purchase_order->date_shippement;
        $this->tier_id=$this->purchase_order->tier_id;
        $this->pricelist=$this->purchase_order->list_price_id;
        $this->p=ListPrice::find($this->purchase_order->list_price_id);
        $this->purchase_order_lines=$this->purchase_order->order_lines;
        $this->lignes=$this->purchase_order_lines;
        $this->reglement=$this->purchase_order->condition_reglement;
    }
    public function updatedPricelist(){

        $this->p=ListPrice::find($this->pricelist);

        $this->lines=PurchaseOrderLine::where('purchase_order_id',$this->order_id)->get();
        $this->lignes=$this->lines;
        $this->amount_ht=0;
        $this->amount_tax=0;
        $this->amount=0;

        foreach($this->lignes as $lgn){

            $this->amount_ht+=$lgn->amount;
            $this->amount_tax+=$lgn->amount*($lgn->taxe->taux ?? 0 )/100;
            $this->amount+=$lgn->amount+($lgn->amount*($lgn->taxe->taux ?? 0)/100);
        }


            $this->remise=$this->amount_ht*$this->p->remise/100;
            $this->amount=$this->amount-$this->remise;

        $this->currency=$this->p->currency->symbole;


    }
    public function updatedProductPrice(){
        $this->subtotal=doubleval($this->product_qty)*doubleval($this->product_price);


    }
    public function updatedProductQty(){
        $this->subtotal=doubleval($this->product_qty)*doubleval($this->product_price);


    }
    public function updatedevis(){
        $this->validate([
            'tier_id'=>"required",
            'date'=>"required|Date",
            'date_ship'=>"required|Date",
            'pricelist'=>'required',
            'reglement'=>'required',
        ]);
        $this->purchase_order->update([
            "tier_id"=>$this->tier_id,
            "list_price_id"=>$this->pricelist,
            "date"=>$this->date,
            "date_shippement"=>$this->date_ship,
            "condition_reglement"=>$this->reglement,
        ]);
        return redirect()->route('devis.show',["devi"=>$this->purchase_order]);

    }
    public function modifyline($id){
        $line=PurchaseOrderLine::find($id);
        $this->product=$line->product_id;
        $this->product_unit=$line->unity->name;
        $this->product_code=$line->product->ref;
        $this->product_qty=$line->product_qty;
        $this->product_price=$line->price_unit;
        $this->product_taxe=$line->taxe_id;
        $this->product_warehouse=$line->warehouse_id;
        $this->subtotal=$line->amount;
        $line->delete();
        $this->lines=PurchaseOrderLine::where('purchase_order_id',$this->order_id)->get();
        $this->lignes=$this->lines;
        $this->amount_ht=0;
        $this->amount_tax=0;
        $this->amount=0;

        foreach($this->lignes as $lgn){

            $this->amount_ht+=$lgn->amount;
            $this->amount_tax+=$lgn->amount*($lgn->taxe->taux ?? 0 )/100;
            $this->amount+=$lgn->amount+($lgn->amount*($lgn->taxe->taux ?? 0)/100);

        }
        $this->p=ListPrice::find($this->pricelist);
        $this->remise=$this->amount_ht*$this->p->remise/100;
        $this->amount=$this->amount-$this->remise;
        $this->intz=2;
    }
    public function deleteline($id){
        $line=PurchaseOrderLine::find($id);
        $line->delete();
        $this->lines=PurchaseOrderLine::where('purchase_order_id',$this->order_id)->get();
        $this->lignes=$this->lines;
        $this->amount_ht=0;
        $this->amount_tax=0;
        $this->amount=0;

        foreach($this->lignes as $lgn){

            $this->amount_ht+=$lgn->amount;
            $this->amount_tax+=$lgn->amount*($lgn->taxe->taux ?? 0 )/100;
            $this->amount+=$lgn->amount+($lgn->amount*($lgn->taxe->taux ?? 0)/100);
        }

        $this->remise=$this->amount_ht*$this->p->remise/100;
        $this->amount=$this->amount-$this->remise;
        $this->purchase_order->update([
            "ammount_ht"=>$this->amount_ht,
            "ammount_tax"=>$this->amount_tax,
            "ammount_total"=>$this->amount,
            "remise"=>$this->remise,
        ]);

    }
    public function addproduct($id){

        $this->validate([
            'tier_id'=>"required",
            'date'=>"required|Date",
            'date_ship'=>"required|Date",
            'pricelist'=>'required',
            'product' => 'required',
            'product_unit' => 'required',
            'product_price' => 'required|numeric|Min:0',
            'product_qty' => 'required|numeric|Min:0',
            'product_code' => 'required',

            'product_warehouse' => 'required',

        ]);
        $pp=Product::find($this->product);
        if($this->product_taxe==''){ $ttaxe=NULL;}else{$ttaxe=$this->product_taxe;}
        $this->purchase_order->order_lines()->create([
                    "company_id"=>$this->purchase_order->company_id,
                    "product_qty"=>$this->product_qty,
                    "price_unit"=>$this->product_price,
                    "amount"=>$this->subtotal,
                    "remise"=>0,
                    "state"=>"brouillon",
                    "user_id"=>$this->purchase_order->user_id,
                    "product_id"=>$this->product,
                    "unity_id"=>$pp->unity->id,
                    "warehouse_id"=>$this->product_warehouse,
                    "taxe_id"=>$ttaxe ,
        ]);
        $this->product="";
        $this->product_unit="";
        $this->product_code="";
        $this->product_qty="";
        $this->product_price=0;
        $this->product_taxe="";
        $this->product_warehouse="";
        $this->subtotal=0;

        $this->lines=PurchaseOrderLine::where('purchase_order_id',$this->order_id)->get();
        $this->lignes=$this->lines;
        $this->amount_ht=0;
        $this->amount_tax=0;
        $this->amount=0;

        foreach($this->lignes as $lgn){

            $this->amount_ht+=$lgn->amount;
            $this->amount_tax+=$lgn->amount*($lgn->taxe->taux ?? 0 )/100;
            $this->amount+=$lgn->amount+($lgn->amount*($lgn->taxe->taux ?? 0)/100);
        }

        $this->remise=$this->amount_ht*$this->p->remise/100;
        $this->amount=$this->amount-$this->remise;
        $this->purchase_order->update([
            "ammount_ht"=>$this->amount_ht,
            "ammount_tax"=>$this->amount_tax,
            "ammount_total"=>$this->amount,
            "remise"=>$this->remise,
        ]);
        $this->intz=1;
    }
    public function updatedDate(){
        if($this->tier_id!=""){
            $t=Tier::find($this->tier_id);
            $this->date_ship=date("Y-m-d",strtotime($this->date."+".$t->delai." days"));
        }else{
            $this->date_ship="";
        }
    }
    public function updatedProduct(){
        if($this->intz!=2){
        if($this->product!=""){
        $prod=Product::find($this->product);
        $this->product_unit=$prod->unity->name;
        $this->product_code=$prod->ref;
        $this->product_price=$prod->standard_price;
        $this->product_taxe=$prod->taxe_id ?? null;
        $this->product_warehouse=$prod->warehouse_id ?? null;
        $this->subtotal=doubleval($this->product_qty)*doubleval($this->product_price);
    }
}
    }
    public function updatedTierId(){
        if($this->tier_id != "" ){
        $t=Tier::find($this->tier_id);
        $this->pricelist=$t->list_price->id;

        $this->p=ListPrice::find($this->pricelist);
        $this->lines=PurchaseOrderLine::where('purchase_order_id',$this->order_id)->get();
        $this->lignes=$this->lines;
        $this->amount_ht=0;
        $this->amount_tax=0;
        $this->amount=0;

        foreach($this->lignes as $lgn){

            $this->amount_ht+=$lgn->amount;
            $this->amount_tax+=$lgn->amount*($lgn->taxe->taux ?? 0 )/100;
            $this->amount+=$lgn->amount+($lgn->amount*($lgn->taxe->taux ?? 0)/100);
        }


            $this->remise=$this->amount_ht*$this->p->remise/100;
            $this->amount=$this->amount-$this->remise;
            $this->currency=$this->p->currency->symbole;
            $this->date_ship=date("Y-m-d",strtotime($this->date."+".$t->delai." days"));


            }

    }
    public function render()
    {



        return view('livewire.edit-devis');
    }
}
