<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Invoice;
use  Illuminate\Support\Facades\Route;
use App\Paiement;
use App\Sequence;
class Voucher extends Component
{
    public $bill;
    public $date;
    public $balance;
    public $warning=False;
    public $balances;

    public function mount(){
        $iid=Route::current()->bill;


        $this->bill=Invoice::find($iid);

        $this->balance=$this->bill->ammount_total;
        foreach($this->bill->vouchers as $line){
            $this->balance -=$line->total;
        }
        $this->balances=$this->balance;
        $this->date=date('Y-m-d');
    }
    public function add_voucher(){
        $this->validate([
            "balances"=>"required|numeric|Min:0",
            "date"=>"required",
        ]);


        if($this->balance < $this->balances){

            $this->warning=True;
            return False;
        }
        $sequence=Sequence::where("origin","voucher")->first();


        $name_reception=$sequence->name.'/';

        if($sequence->year==1){
            $year=date('Y');
            $name_reception.=$year.'/';
        }
        if($sequence->month){
            $month=date('m');
            $name_reception.=$month.'/';
        }
        if($sequence->day){
            $day=date('d');
            $name_reception.=$day.'/';
        }
        $next=$sequence->next_number;
        $numb="";
        for($j=strlen($next);$j<$sequence->remplissage;$j++){
            $numb.="0";

        }
        $name_reception.=$numb.$next;
        $this->bill->vouchers()->create([
            "name"=>$name_reception,
            "tier_id"=>$this->bill->tier_id,
            "company_id"=>$this->bill->company_id,
            "user_id"=>$this->bill->user_id,
            "total"=>$this->balances,
            "date"=>$this->date,
        ]);
        $sequence->update([
            "next_number"=>$sequence->next_number+$sequence->increment,
        ]);
        if($this->balance == $this->balances){

            $this->bill->update([
                "state"=>"Payé",
            ]);
        }
        return redirect()->route('bills.show',["bill"=>$this->bill->id]);
    }
    public function render()
    {



        return view('livewire.voucher');
    }
}
