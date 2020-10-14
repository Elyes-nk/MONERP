<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\ListPrice;
use App\Currency;
use Livewire\WithPagination;
class ListPricesSearch extends Component
{


    public $currencies;
    public $pages=10;
    public $name;

    use WithPagination;
    public function updatingPages(){
        $this->resetPage();
    }
    public function updatingName(){
        $this->resetPage();
    }
    public function searchByName(){

        $this->listPrices=ListPrice::searchByName($this->name);
    }


    public function render(){

    $this->currencies=Currency::all();
        return view('livewire.list-prices-search',['listPrices'=>ListPrice::where('name','like','%'.$this->name.'%')->paginate($this->pages)]);
    }
}
