<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\ReplishippementRule;
use Livewire\WithPagination;

class ReplenishmentRulesSearch extends Component
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
    public function searchByName()
    {
        $this->replenishmentRules=ReplishippementRule::searchByName($this->name);
    }
    public function render()
    {
        return view('livewire.replenishment-rules-search',['replenishmentRules'=>ReplishippementRule::where("name","like","%".$this->name."%")->paginate($this->pages)]);
    }
}
