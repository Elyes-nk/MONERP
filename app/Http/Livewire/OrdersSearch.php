<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Tier;
use App\PurchaseOrder;
use Livewire\WithPagination;
class OrdersSearch extends Component
{
    public $pages=10;
    public $name;
    public $tiers;
    use WithPagination;
    public function updatingPages(){
        $this->resetPage();
    }
    public function updatingName(){
        $this->resetPage();
    }

    public function mount(){

        $this->tiers=Tier::all();
    }

    public function render()
    {


        return view('livewire.orders-search',['commandes'=>PurchaseOrder::where("state",'<>',"brouillon")->where("name","like","%".$this->name."%")->orderBy('id','desc')->paginate($this->pages)]);
    }
}
