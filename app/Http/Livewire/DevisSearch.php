<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Tier;
use App\PurchaseOrder;
use App\ListPrice;

class DevisSearch extends Component
{
    public $name;
    public $listPrices;
    public $tiers;
    public $devis;
    public function mount(){
        $this->devis=PurchaseOrder::where("state","brouillon")->get();

    }
    public function searchByName(){

        $this->devis=PurchaseOrder::searchdevisByName($this->name);

    }


    public function render()
    {   if($this->name==""){
        $this->devis=PurchaseOrder::where("state","brouillon")->get();

    }
    dd($this->devis);
    $this->tiers=Tier::all();
    $this->listPrices=ListPrice::all();
        return view('livewire.devis-search');
    }
}
