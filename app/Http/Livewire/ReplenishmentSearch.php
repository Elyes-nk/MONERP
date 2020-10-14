<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\ReplishippementOrder;
use App\Currency;
use Livewire\WithPagination;

class ReplenishmentSearch extends Component
{

    public $name;
    public $pages=10;
    public $currencies=[];

    use WithPagination;
    public function updatingPages(){
        $this->resetPage();
    }
    public function updatingName(){
        $this->resetPage();
    }
    public function searchByName()
    {
        $this->replenishments=ReplishippementOrder::searchByName($this->name);
    }
    public function render()
    {
        $this->currenices=Currency::all();
        return view('livewire.replenishment-search',['replenishments'=>ReplishippementOrder::where("name","like","%".$this->name."%")->orderBy('id','desc')->paginate($this->pages)]);
    }
}
