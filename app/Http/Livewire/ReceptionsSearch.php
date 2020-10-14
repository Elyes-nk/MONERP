<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Reception;
use App\Tier;
use Livewire\WithPagination;
class ReceptionsSearch extends Component
{

    public $pages=10;
    public $name;

    public $tiers;
    use WithPagination;
    public function updatingPages(){
        $this->resetPage();
    }
    public function updatingName(){
        $this->resetPage();
    }
    public function mount(){



    }

    public function render()
    {

        $this->tiers=Tier::all();
        if(isset($_GET['name'])){
            $this->name=$_GET['name'];
            $id_order=$_GET['order'];
            return view('livewire.receptions-search',["receptions"=>Reception::where("type","in")->where("purchase_order_id",$id_order)->orderBy('id','desc')->paginate($this->pages)]);

        }else{
        return view('livewire.receptions-search',["receptions"=>Reception::where("type","in")->where("name","like","%".$this->name)->orderBy('id','desc')->paginate($this->pages)]);
    }
}
}
