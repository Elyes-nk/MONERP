<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Sequence;
class SequencesSearch extends Component
{


    public $name;
    public $sequences=[];


    public function searchByName(){

        $this->sequences=Sequence::searchByName($this->name);
    }


    public function render()
    {   if($this->name==""){
        $this->sequences=Sequence::all()->all();
    }
        return view('livewire.sequences-search');
    }
}
