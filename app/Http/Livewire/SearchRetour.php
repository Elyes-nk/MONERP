<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Reception;
use App\Tier;
use Livewire\WithPagination;
class SearchRetour extends Component
{
    public $name;
    public $pages=10;
    public $tiers;

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
        return view('livewire.search-retour',["receptions"=>Reception::where("type","out")->where("name","like","%".$this->name."%")->orderBy('id','desc')->paginate($this->pages)]);
    }
}
