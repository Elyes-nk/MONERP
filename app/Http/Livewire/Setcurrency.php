<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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
class Setcurrency extends Component
{
    public $listprices;
    public $name;
    public $tiers;
    public $currency;
    public $pricelist;
    public $produits;
    public $units;
    public $taxes;
    public $warehouses;
    public $product;
    public $product_code;
    public $product_qty;
    public $product_price;
    public $product_unit;
    public $product_taxe;
    public $product_warehouse;
    public $set_price;
    public $set_qty;
    public $subtotal;
    public $lignes=[];
    public $i;
    public $amount_untaxed=0;
    public $amount_tax=0;
    public $amount=0;
    public $date;
    public $dateship;
    public $reglement;
    public $intz=0;
    public $remise=0;
    public function mount(){
        $this->lignes=[];
        $this->i=0;
        $this->date=date('Y-m-d');
        $this->date_ship=date('Y-m-d');

    }

    public function updatedProductPrice(){
        $this->subtotal=doubleval($this->product_price)*doubleval($this->product_qty);
    }
    public function updatedProductQty(){
        $this->subtotal=doubleval($this->product_price)*doubleval($this->product_qty);
    }
    public function updatedDate(){
        if($this->name!=""){
            $t=Tier::find($this->name);
            $this->dateship=date("Y-m-d",strtotime($this->date."+".$t->delai." days"));
        }else{
            $this->dateship="";
        }
    }
    public function updatedProduct(){
        if($this->product != ""){
        $prod=Product::find($this->product);


            $this->product_code=$prod->ref;


            $this->product_unit=$prod->unity->id;


            $this->product_price=$prod->standard_price;


            $this->product_warehouse=$prod->warehouse->id ?? null;

            $this->product_taxe=$prod->taxe->id ?? null;

            $this->subtotal=doubleval($this->product_price)*doubleval($this->product_qty);

        }
    }
    public function modifyline($index){

        $this->product=$this->lignes[$index]['product_id'];
        $this->product_code=$this->lignes[$index]['code'];
        $this->product_unit=$this->lignes[$index]['unit_id'];
        $this->product_qty=$this->lignes[$index]['qty'];
        $this->product_price=$this->lignes[$index]['price'];
        $this->product_warehouse=$this->lignes[$index]['warehouse_id'];
        $this->product_taxe=$this->lignes[$index]['taxe_id'];
        $this->subtotal=$this->lignes[$index]['subtotal'];
        unset($this->lignes[$index]);

        $this->lignes=$this->lignes;

        $this->amount_untaxed=0;
        $this->amount_tax=0;
        $this->amount=0;
        foreach($this->lignes as $lgn){
            $this->amount_untaxed+=$lgn['subtotal'];
            $this->amount_tax+=$lgn['subtotal']*$lgn['taxe_taux']/100;
            $this->amount+=$lgn['subtotal']+($lgn['subtotal']*$lgn['taxe_taux']/100);
        }
        $pl=ListPrice::find($this->pricelist);
        $this->remise=$this->amount_untaxed*$pl->remise/100;
        $this->amount=$this->amount-$this->remise;
        $this->intz=2;
    }
    public function deleteline($index){
        unset($this->lignes[$index]);
        $this->amount_untaxed=0;
        $this->amount_tax=0;
        $this->amount=0;
        foreach($this->lignes as $lgn){
            $this->amount_untaxed+=$lgn['subtotal'];
            $this->amount_tax+=$lgn['subtotal']*$lgn['taxe_taux']/100;
            $this->amount+=$lgn['subtotal']+($lgn['subtotal']*$lgn['taxe_taux']/100);
        }
        $pl=ListPrice::find($this->pricelist);
        $this->remise=$this->amount_untaxed*$pl->remise/100;
        $this->amount=$this->amount-$this->remise;
    }
    public function updatedPricelist(){

        $pl=ListPrice::find($this->pricelist);
        $this->remise=$this->amount_untaxed*$pl->remise/100;
        $this->amount=$this->amount-$this->remise;
        $this->currency=$pl->currency->symbole;

    }
    public function addproduct(){

        $this->validate([
            'name'=>"required",
            'date'=>"required|Date",
            'dateship'=>"required|Date",
            'pricelist'=>'required',
            'product' => 'required',
            'product_unit' => 'required',
            'product_price' => 'required|numeric|Min:0',
            'product_qty' => 'required|numeric|Min:0',
            'product_code' => 'required',
            'reglement'=>'required',
            'product_warehouse' => 'required',

        ]);
        $prod=Product::find($this->product);
        $line_taxe=Taxe::find($this->product_taxe);
        $line_warehouse=Warehouse::find($this->product_warehouse);
        $this->lignes[$this->i]=[
        'product_id'=>$prod->id,
        'product'=>$prod->name,
        'code'=>$this->product_code,
        'unit_id'=>$prod->unity->id,
        'unit'=>$prod->unity->name,
        'price'=>$this->product_price,
        'warehouse_id'=>$line_warehouse->id ?? null,
        'warehouse'=>$line_warehouse->name ?? null,
        'taxe_id'=>$line_taxe->id ?? null,
        'taxe'=>$line_taxe->name ?? null,
        'taxe_taux'=>$line_taxe->taux ?? 0,
        'subtotal'=>$this->subtotal,
        'qty'=>$this->product_qty,
        'index'=>$this->i,
        ];

        $this->amount_untaxed=0;
        $this->amount_tax=0;
        $this->amount=0;
        foreach($this->lignes as $lgn){
            $this->amount_untaxed+=$lgn['subtotal'];
            $this->amount_tax+=$lgn['subtotal']*$lgn['taxe_taux']/100;
            $this->amount+=$lgn['subtotal']+($lgn['subtotal']*$lgn['taxe_taux']/100);
        }
        $pl=ListPrice::find($this->pricelist);
        $this->remise=$this->amount_untaxed*$pl->remise/100;
        $this->amount=$this->amount-$this->remise;
        $this->i+=1;
        $this->product="";
        $this->product_code="";
        $this->product_taxe="";

        $this->product_unit="";


            $this->product_price="";
            $this->product_qty="";

        $this->product_warehouse="";

        $this->taxe="";

        $this->subtotal="";
        $this->intz=1;
    }
    public function adddevis(){
        $company=Company::first();
        $sequence=Sequence::where("origin","orders")->first();

        $name_devis=$sequence->name.'/';

        if($sequence->year==1){
            $year=date('Y');
            $name_devis.=$year.'/';
        }
        if($sequence->month){
            $month=date('m');
            $name_devis.=$month.'/';
        }
        if($sequence->day){
            $day=date('d');
            $name_devis.=$day.'/';
        }
        $next=$sequence->next_number;
        $numb="";
        for($j=strlen($next);$j<$sequence->remplissage;$j++){
            $numb.="0";

        }
        $name_devis.=$numb.$next;
        $order=$company->purchase_orders()->create([
            "user_id"=>Auth::user()->id,
            "name"=>$name_devis,
            "tier_id"=>$this->name,
            "date"=>$this->date,
            "remise"=>$this->remise,
            "date_shippement"=>$this->dateship,
            "ammount_ht"=>$this->amount_untaxed,
            "ammount_tax"=>$this->amount_tax,
            "ammount_total"=>$this->amount,
            "list_price_id"=>$this->pricelist,
            "condition_reglement"=>$this->reglement
        ]);
        foreach($this->lignes as $lgn){

            $order->order_lines()->create(
                [
                    "company_id"=>$order->company->id,
                    "product_qty"=>$lgn['qty'],
                    "price_unit"=>$lgn['price'],
                    "amount"=>$lgn['subtotal'],
                    "remise"=>0,
                    "state"=>"brouillon",
                    "user_id"=>$order->user_id,
                    "product_id"=>$lgn['product_id'],
                    "unity_id"=>$lgn['unit_id'],
                    "warehouse_id"=>$lgn['warehouse_id'],
                    "taxe_id"=>$lgn['taxe_id']

                ]
                );
        }
        $sequence->update([
            "next_number"=>$next+$sequence->increment,
        ]);

        return redirect()->route('devis.show',['devi'=>$order->id]);

    }
    public function updatedName(){
        $t=Tier::find($this->name);
        $this->pricelist=$t->list_price->id;
        $p=ListPrice::find($this->pricelist);

        $this->currency=$p->currency->symbole;
        $this->dateship=date("Y-m-d",strtotime($this->date."+".$t->delai." days"));

    }
    public function render()
    {

        $this->produits=Product::all();
        $this->units=ProductUnity::all();
        $this->taxes=Taxe::all();
        $this->warehouses=Warehouse::all();
        $this->lignes=$this->lignes;
        $this->tiers=Tier::all();
        $this->listprices=ListPrice::all();
        return view('livewire.setcurrency');
    }
}
