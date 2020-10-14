<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Product;
use Livewire\WithPagination;
class ProductsSearch extends Component
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



    public function render()
{
        return view('livewire.products-search',['products'=>Product::where("name","like","%".$this->name."%")->orderBy('id','desc')->paginate($this->pages)]);
    }
}
