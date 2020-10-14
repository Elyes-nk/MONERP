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
    public $commandes;
    public function searchByName(){

        $this->commandes=PurchaseOrder::searchcommandesByName($this->name);
    }


    public function render()
    {   if($this->name==""){
        $this->commandes=PurchaseOrder::where("state","confirmed")->get()->all();

    }
    $this->tiers=Tier::all();
    $this->listPrices=ListPrice::all();
        return view('livewire.commandes-search');
    }
}
