<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\ProductUnity;
use Livewire\WithPagination;
class UnityProductSearch extends Component
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

        $this->unityProducts=ProductUnity::searchByName($this->name);
    }


    public function render(){

        return view('livewire.unity-product-search',['unityProducts'=>ProductUnity::where('name','like','%'.$this->name.'%')->paginate($this->pages)]);
    }
}
