<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Route;
use App\ReplishippementRule;
use App\ReplishippementRuleLine;
class PlanificateProcurement extends Component
{
    public $rep_id;
    public $rep;
    public $lignes;
    public $date;
    public $product_qty;
    public $state="en attente";
    public $index=null;
    public $warning;

    public function mount(){
        $this->rep_id=Route::current()->replenishmentRule;
        $this->rep=ReplishippementRule::find($this->rep_id);

        $this->lignes=ReplishippementRuleLine::where('replishippement_rule_id',$this->rep->id)->get();

    }
    public function addplane($id){
        if($this->index==null){
        $this->validate([
            "date"=>'required|date',
            "product_qty"=>'required|numeric|Min:0'
        ]);
        if(($this->date<date('Y-m-d'))||($this->product_qty<=0)){
            $this->warning=True;
            return True;
        }

        $this->rep->lines()->create([
            "date"=>$this->date,
            "product_qty"=>$this->product_qty,
            "company_id"=>$this->rep->company_id,
            "user_id"=>$this->rep->user_id,
            "state"=>$this->state,

        ]);

        $this->lignes=ReplishippementRuleLine::where('replishippement_rule_id',$this->rep->id)->get();
        $this->date=null;
        $this->index=null;
        $this->product_qty=null;
        $this->state="en attente";
    }else{
        $this->validate([
            "date"=>'required|date',
            "product_qty"=>'required|numeric|Min:0'
        ]);
        if(($this->date<date('Y-m-d'))||($this->product_qty<=0)){
            $this->warning=True;
            return True;
        }

        $line=ReplishippementRuleLine::find($this->index);
        $line->update([
            "date"=>$this->date,
            "product_qty"=>$this->product_qty,
            "company_id"=>$this->rep->company_id,
            "user_id"=>$this->rep->user_id,
            "state"=>$this->state,

        ]);
        $this->lignes=ReplishippementRuleLine::where('replishippement_rule_id',$this->rep->id)->get();
        $this->date=null;
        $this->index=null;
        $this->product_qty=null;
        $this->state="en attente";
    }
    }
    public function modifyline($id){
        $line=ReplishippementRuleLine::find($id);
        $this->date=$line->date;
        $this->state=$line->state;
        $this->index=$line->id;
        $this->product_qty=$line->product_qty;
        $this->lignes=ReplishippementRuleLine::where('replishippement_rule_id',$this->rep->id)->where('id','<>',$id)->get();
    }
    public function deleteline($id){
        $line=ReplishippementRuleLine::find($id);
        $line->delete();
        $this->lignes=ReplishippementRuleLine::where('replishippement_rule_id',$this->rep->id)->get();
    }
    public function render()
    {
        return view('livewire.planificate-procurement');
    }
}
