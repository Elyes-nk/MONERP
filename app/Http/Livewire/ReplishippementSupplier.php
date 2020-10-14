<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Tier;
class ReplishippementSupplier extends Component
{
    public $name;
    public $lignes=[];
    public $price;
    public $qtt_min;
    public $delai;
    public $tiers;
    public $i=0;
    public $cmpt=0;
    public $i_id=0;
    public function mount(){
        $this->tiers=Tier::all();
    }
    public function updatedName(){
        $sup=Tier::find($this->name);
        $this->delai=$sup->delai;
    }
    public function deleteline($index){
        unset($this->lignes[$index]);
        $this->cmpt-=1;

    }
    public function addsupllier(){
        $this->validate([
            'name'=>"required",
            'price' => 'required|numeric|Min:0',
            'qtt_min' => 'required|numeric|Min:0',
            'delai' =>  'required|numeric|Min:0',


        ]);
        $sup=Tier::find($this->name);
        $this->lignes[$this->i]=[
            "tier_id"=>$this->name,
            "tier_name"=>$sup->name,
            "delai"=>$this->delai,
            "prix"=>$this->price,
            "qtt_min"=>$this->qtt_min,
            "index"=>$this->i,
        ];
        $this->i+=1;
        $this->cmpt+=1;
        $this->name="";
        $this->delai="";
        $this->price="";
        $this->qtt_min="";
    }
    public function modifyline($index){
        $this->name=$this->lignes[$index]['tier_id'];
        $this->delai=$this->lignes[$index]['delai'];
        $this->qtt_min=$this->lignes[$index]['qtt_min'];
        $this->price=$this->lignes[$index]['prix'];
        unset($this->lignes[$index]);
        $this->cmpt-=1;
    }
    public function render()
    {

        return view('livewire.replishippement-supplier');
    }
}
