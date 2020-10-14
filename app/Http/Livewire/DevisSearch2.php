<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Tier;
use App\PurchaseOrder;
use App\ListPrice;
use Livewire\WithPagination;
class DevisSearch2 extends Component
{
    public $pages=10;
    public $name;
    public $listPrices;
    public $tiers;

    use WithPagination;
    public function updatingPages(){
        $this->resetPage();
    }
    public function updatingName(){
        $this->resetPage();
    }
    public function mount(){
        $this->devis=PurchaseOrder::where("state","brouillon")->paginate($this->pages);


    }

    public function render()
    {


        $this->tiers=Tier::all();
        $this->listPrices=ListPrice::all();

        return view('livewire.devis-search2',["devis"=>PurchaseOrder::where("name","like","%".$this->name."%")->where("state","brouillon")->orderBy("id","desc")->paginate($this->pages)]);
    }
}
