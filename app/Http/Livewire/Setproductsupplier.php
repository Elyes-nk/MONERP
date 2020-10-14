<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Tier;
class Setproductsupplier extends Component
{
    public $name;
    public $lignes=[];
    public $price;
    public $qtt_min;
    public $delai;
    public $tiers;
    public function mount(){
        $this->tiers=Tier::all();
    }

    public function render()
    {


        return view('livewire.setproductsupplier');
    }
}
