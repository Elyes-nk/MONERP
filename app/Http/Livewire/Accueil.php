<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\PurchaseOrder;
use App\Reception;
use App\Invoice;
use App\ReplishippementOrder;



class Accueil extends Component
{
    public $Devis=0;
    public $Commandes=0;
    public $Reception=0;
    public $ReceptionRetard=0;
    public $Bills=0;
    public $BillsEcheance=0;
    public $Replinishment=0;

    public function mount()
    {
        $DBDevis = PurchaseOrder::where("state","brouillon")->count();
        $this->Devis = $DBDevis;
        $DBCommandes = PurchaseOrder::where('state','confirmed')->where('date_shippement','<',date('Y-m-d'))->get();
        $n=0;
        foreach($DBCommandes as $dbc)
        {
           $rec=$dbc->receptions->first();
           if($rec)
           {
                if($rec->state!="Reçu")
                {
                    $n++;
                }
           }   
        }
        $this->Commandes = $n;

        $DBReception = Reception::where('state','assigned')->count();
        $this->Reception = $DBReception;
        $DBReceptionRetard = Reception::where('state','assigned')->where('date_shippement','<',date('Y-m-d'))->count();
        $this->ReceptionRetard = $DBReceptionRetard;

        $DBBills = Invoice::where('state','brouillon')->count();
        $this->Bills = $DBBills;
        $DBBillsEcheance = Invoice::where('state','Ouverte')->where('date_due','<',date('Y-m-d'))->count();
        $this->BillsEcheance = $DBBillsEcheance;

        $DBReplinishment = ReplishippementOrder::where('state','En exception')->count();
        $this->Replinishment = $DBReplinishment;
    }

    public function render()
    {
        
        return view('livewire.accueil');
    }
}
