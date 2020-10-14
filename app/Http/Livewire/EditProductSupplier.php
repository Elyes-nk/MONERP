<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Tier;
use App\Product;
use App\Taxe;
use App\Warehouse;
use App\CategoryProduct;
use App\ProductUnity;
use App\ProductSupplierRel;
use Illuminate\Support\Facades\Route;
use Auth;
class EditProductSupplier extends Component
{
    public $product;
    public $product_id;
    public $Taxes;
    public $Category_products;
    public $Warehouses;
    public $Product_unities;
    public $name;
    public $delai;
    public $qtt_min;
    public $tiers;
    public $price;
    public $tier_id;
    public $index;
    public $lignes;
    public function mount(){

        $this->product_id=Route::current()->product;
        $this->product=Product::find($this->product_id);$this->Taxes=Taxe::all();
        $this->Category_products=CategoryProduct::all();
        $this->Warehouses=Warehouse::all();
        $this->Product_unities=ProductUnity::all();
        $this->tiers=Tier::all();
        $this->lignes=ProductSupplierRel::where('product_id',$this->product_id)->get();
    }
    public function updatedTierId(){

        $f=Tier::find($this->tier_id);
        $this->delai=$f->delai;
    }
    public function addsupllier($line_id){
        if($line_id){
            $psup=ProductSupplierRel::find($line_id);
            $this->validate([
                'tier_id'=>"required",
                'price' => 'required|numeric|Min:0',
                'qtt_min' => 'required|numeric|Min:0',
                'delai' =>  'required|numeric|Min:0',
            ]);
            $psup->update([
                "tier_id"=>$this->tier_id,
                "delai"=>$this->delai,
                "price"=>$this->price,
                "qtt_min"=>$this->qtt_min,

            ]);
            $this->tier_id=null;
            $this->delai=null;
            $this->price=null;

            $this->qtt_min=null;
            $this->index=null;
            $this->lignes=ProductSupplierRel::where('product_id',$this->product_id)->get();
        }else{
            $this->validate([
                'tier_id'=>"required",
                'price' => 'required|numeric|Min:0',
                'qtt_min' => 'required|numeric|Min:0',
                'delai' =>  'required|numeric|Min:0',
            ]);
            $this->product->suppliers()->create([
                "tier_id"=>$this->tier_id,
                "delai"=>$this->delai,
                "price"=>$this->price,
                "qtt_min"=>$this->qtt_min,
                "company_id"=>$this->product->company_id,
                "user_id"=>Auth::user()->id,
            ]);
            $this->tier_id=null;
            $this->delai=null;
            $this->price=null;

            $this->qtt_min=null;
            $this->index=null;
            $this->lignes=ProductSupplierRel::where('product_id',$this->product_id)->get();
        }
    }
    public function modifyline($line_id){
        $line=ProductSupplierRel::find($line_id);
        $this->tier_id=$line->tier_id;
        $this->delai=$line->delai;
        $this->price=$line->price;

        $this->qtt_min=$line->qtt_min;
        $this->index=$line->id;
        $this->lignes=ProductSupplierRel::where('product_id',$this->product_id)->where('id','<>',$line_id)->get();
    }
    public function deleteline($line_id){
        $psup=ProductSupplierRel::find($line_id);
        $psup->delete();
        $this->lignes=ProductSupplierRel::where('product_id',$this->product_id)->get();
    }
    public function render()
    {

        return view('livewire.edit-product-supplier');
    }
}
