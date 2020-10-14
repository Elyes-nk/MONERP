<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Warehouse;
class WarehousesSearch extends Component
{
    public $name;
    public $warehouses=[];


    public function searchByName(){

        $this->warehouses=Warehouse::searchByName($this->name);
    }


    public function render()
    {   if($this->name==""){
        $this->warehouses=Warehouse::all()->all();
    }
        return view('livewire.warehouses-search');
    }
}
