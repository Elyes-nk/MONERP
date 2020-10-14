<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Invoice;
use App\Tier;
use App\ListPrice;
use Livewire\WithPagination;
class BillsSearch extends Component
{

    public $name;
    public $listPrices;
    public $tiers;
    public $pages=10;
    use WithPagination;
    public function updatingPages(){
        $this->resetPage();
    }
    public function updatingName(){
        $this->resetPage();
    }
    public function render()
    {


        $this->tiers=Tier::all();
        $this->listPrices=ListPrice::all();
        return view('livewire.bills-search',['bills'=>Invoice::where("name","like","%".$this->name."%")->orderBy('id','desc')->paginate($this->pages)]);
    }
}
