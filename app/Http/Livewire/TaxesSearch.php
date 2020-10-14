<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Taxe;
use Livewire\WithPagination;
class TaxesSearch extends Component
{

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

        $this->taxes=Taxe::searchByName($this->name);
    }


    public function render()
    {
        return view('livewire.taxes-search',["taxes"=>Taxe::where("name","like","%".$this->name."%")->paginate($this->pages)]);
    }
}
