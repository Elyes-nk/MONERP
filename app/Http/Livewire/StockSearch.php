<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Product;
use App\ReceptionLine;
use Livewire\WithPagination;
class StockSearch extends Component
{
    public $name;
    public $pages=10;
    use WithPagination;
    public function updatingPages(){
        $this->resetPage();
    }
    public function updatingName(){
        $this->resetPage();
    }
    public function mount(){
        $products=Product::where("type","stockable")->get();
        foreach($products as $product){
            $lines=ReceptionLine::where('product_id',$product->id)->get();
            $stk_v=0;
            $stk_p=0;

            foreach($lines as $line){
                if(($line->state=="Reçu")&&($line->type=="in")){
                    $stk_p+=$line->product_qty;
                }elseif(($line->state=="assigned")||($line->state=="confirmed")&&($line->type=="in")){
                    $stk_v+=$line->product_qty;
                }
                if(($line->state=="Livré")&&($line->type=="out")){
                    $stk_p-=$line->product_qty;
                }elseif(($line->state=="assigned")&&($line->type=="out")){
                    $stk_v-=$line->product_qty;
                }

            }

            $product->update([
            "physical_stock"=>$stk_p,
                "virtual_stock"=>$stk_v,
            ]);
        }
    }
    public function render()
    {

        return view('livewire.stock-search',["products"=>Product::where('type','stockable')->where('name','like','%'.$this->name.'%')->paginate($this->pages)]);
    }
}
