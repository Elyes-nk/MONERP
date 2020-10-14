<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Currency;
use Livewire\WithPagination;
class CurrenciesSearch extends Component
{
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

        $this->currencies=Currency::searchByName($this->name);
    }
    public function render()
    {

        return view('livewire.currencies-search',["currencies"=>Currency::where('name','like','%'.$this->name.'%')->paginate($this->pages)]);
    }
}
