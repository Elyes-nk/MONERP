<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\ListPrice;
use App\Tier;
use Livewire\WithPagination;
class TiersSearch extends Component
{


    public $listPrices=[];
    public $name;
    public $pages=10;
    use WithPagination;
    public function updatingPages(){
        $this->resetPage();
    }
    public function updatingName(){
        $this->resetPage();
    }
    public function searchByName(){

        $this->tiers=Tier::searchByName($this->name);
    }


    public function render(){

        $this->listPrices=ListPrice::all()->all();
        return view('livewire.tiers-search',['tiers'=>Tier::where('name','like','%'.$this->name.'%')->paginate($this->pages)]);
    }
}
