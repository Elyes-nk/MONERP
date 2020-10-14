<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Reception;
use  Illuminate\Support\Facades\Route;
use App\Sequence;
use Auth;
use App\TypeMove;
use App\PartialPicking;
use App\PartialPickingLine;
use App\ReceptionLine;
use App\PurchaseOrder;
class ValidateQty extends Component
{
    public $qty=[];
    public $reception;
    public $lignes=[];
    public $index;
    public $put_lignes=[];
    public $product_qty;
    public $warning_qty=False;
    public function mount(){

        $this->reception=Reception::find(Route::current()->reception);
        $this->index=0;

        foreach($this->reception->reception_lines as $line){

            $this->lignes[$this->index]=[
                "product_id"=>$line->product_id,
                "product_name"=>$line->product->name,
                "product_code"=>$line->product->ref,
                "unit_id"=>$line->product->unity->id,
                "unit_name"=>$line->product->unity->name,
                "qty_command"=>$line->product_qty_command,
                "product_qty"=>$line->product_qty,
                "state"=>$line->state,
                "qty_shipped"=>$line->product_qty_shipped,
                "warehouse_id"=>$line->warehouse_id,
                "warehouse_name"=>$line->warehouse->name,
                "index"=>$this->index,
                "move_line"=>$line->id,
            ];
            $this->index+=1;

        }



    }

    public function addproduct(){
        $this->index+=1;
        foreach($this->put_lignes as $lgn){
            $d=$lgn["product_qty"];
            $this->validate([
                "product_qty"=>'required',
            ]);

        if(($this->product_qty>$d)||($this->product_qty<=0)){
            $this->warning_qty=True;
            return True;
        }
        $this->index+=1;
        $this->lignes[$this->index]=[
            "product_id"=>$lgn['product_id'],
                "product_name"=>$lgn['product_name'],
                "product_code"=>$lgn['product_code'],
                "unit_id"=>$lgn['unit_id'],
                "unit_name"=>$lgn['unit_name'],
                "qty_command"=>$lgn['qty_command'],
                "product_qty"=>$this->product_qty,

                "qty_shipped"=>$lgn['qty_shipped'],
                "warehouse_id"=>$lgn['warehouse_id'],
                "warehouse_name"=>$lgn['warehouse_name'],
                "index"=>$this->index,
                "move_line"=>$lgn['move_line']
        ];
    }
    $this->put_lignes=[];
    }
    public function modifyline($i){
        if(count($this->put_lignes)!=0){
            foreach($this->put_lignes as $lgn){
                $d=$lgn["product_qty"];


            if(($this->product_qty>$d)||($this->product_qty<=0)){
                $this->warning_qty=True;
                return True;
            }
            $this->index+=1;
            $this->lignes[$this->index]=[
                "product_id"=>$lgn['product_id'],
                    "product_name"=>$lgn['product_name'],
                    "product_code"=>$lgn['product_code'],
                    "unit_id"=>$lgn['unit_id'],
                    "unit_name"=>$lgn['unit_name'],
                    "qty_command"=>$lgn['qty_command'],
                    "product_qty"=>$this->product_qty,

                    "qty_shipped"=>$lgn['qty_shipped'],
                    "warehouse_id"=>$lgn['warehouse_id'],
                    "warehouse_name"=>$lgn['warehouse_name'],
                    "index"=>$this->index,
                    "move_line"=>$lgn['move_line'],
            ];
            $this->product_qty="";
            $this->put_lignes=[];
            $this->put_lignes[$i]=[
                "product_id"=>$this->lignes[$i]['product_id'],
                    "product_name"=>$this->lignes[$i]['product_name'],
                    "product_code"=>$this->lignes[$i]['product_code'],
                    "unit_id"=>$this->lignes[$i]['unit_id'],
                    "unit_name"=>$this->lignes[$i]['unit_name'],
                    "qty_command"=>$this->lignes[$i]['qty_command'],
                    "product_qty"=>$this->lignes[$i]['product_qty'],

                    "qty_shipped"=>$this->lignes[$i]['qty_shipped'],
                    "warehouse_id"=>$this->lignes[$i]['warehouse_id'],
                    "warehouse_name"=>$this->lignes[$i]['warehouse_name'],
                    "index"=>$i,
                    "move_line"=>$this->lignes[$i]['move_line']
            ];

            unset($this->lignes[$i]);
        }
        }else{
        $this->product_qty="";
        $this->put_lignes[$i]=[
            "product_id"=>$this->lignes[$i]['product_id'],
                "product_name"=>$this->lignes[$i]['product_name'],
                "product_code"=>$this->lignes[$i]['product_code'],
                "unit_id"=>$this->lignes[$i]['unit_id'],
                "unit_name"=>$this->lignes[$i]['unit_name'],
                "qty_command"=>$this->lignes[$i]['qty_command'],
                "product_qty"=>$this->lignes[$i]['product_qty'],

                "qty_shipped"=>$this->lignes[$i]['qty_shipped'],
                "warehouse_id"=>$this->lignes[$i]['warehouse_id'],
                "warehouse_name"=>$this->lignes[$i]['warehouse_name'],
                "index"=>$i,
                "move_line"=>$this->lignes[$i]['move_line'],
        ];

        unset($this->lignes[$i]);
    }
    }
    public function luanch_receipt(){
        $picking=PartialPicking::create([
            "company_id"=>$this->reception->company_id,
            "user_id"=>Auth::user()->id,
            "reception_id"=>$this->reception->id,
        ]);
        foreach($this->lignes as $lgn){

            $picking->lines()->create([
                "company_id"=>$this->reception->company_id,
                "user_id"=>Auth::user()->id,
                "product_id"=>$lgn['product_id'],
                "reception_line_id"=>$lgn['move_line'],
                "qty"=>$lgn['product_qty'],
            ]);
        }
        $all=true;
        if(count($this->reception->reception_lines)==count($picking->lines)){
            foreach($picking->lines as $line){
                $lgn=ReceptionLine::find($line->reception_line_id);
                if($line->qty != $lgn->product_qty){
                    $all=false;
                }
            }
            if($all){
                $this->reception->update(
                    ["state"=>"Reçu"
                    ]);

                foreach($this->reception->reception_lines as $line){
                    $line->update([
                        "state"=>"Reçu"
                    ]);

            }
            $order=PurchaseOrder::find($this->reception->purchase_order_id);


        }
        else{
        $sequence=Sequence::where("origin","reception")->first();
        $type_move=TypeMove::where("name","mouvement fournisseur")->where("type","in")->first();

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
        $r=Reception::create([
            "name"=>$this->reception->name,
            "date"=>date("Y-m-d"),
            "date_shippement"=>date("Y-m-d"),
            "type"=>$type_move->type,
            "state"=>"Reçu",
            "company_id"=>$this->reception->company_id,
            "user_id"=>Auth::user()->id,
            "tier_id"=>$this->reception->tier_id,
            "purchase_order_id"=>$this->reception->purchase_order_id,
        ]);
        $this->reception->update([
            "name"=>$name_reception,
        ]);
        foreach($picking->lines as $line){
            $lgn=ReceptionLine::find($line->reception_line_id);
            if($line->qty == $lgn->product_qty){
                $lgn->update([
                    "state"=>"Reçu",
                    "reception_id"=>$r->id,
                ]);
            }else{
                $r->reception_lines()->create([
                    "product_qty_command"=>$lgn->product_qty_command,
                    "product_qty_shipped"=>$lgn->product_qty_command+$lgn->product_qty_shipped,
                    "product_qty"=>$line->qty,
                    "state"=>"Reçu",
                    "type"=>$type_move->type,
                    "company_id"=>$r->company_id,
                    "user_id"=>Auth::user()->id,
                    "product_id"=>$line->product_id,
                    "product_unity_id"=>$lgn->product_unity_id,
                    "warehouse_id"=>$lgn->warehouse_id,
                    "type_move_id"=>$type_move->id,
                    "purchase_order_line_id"=>$lgn->purchase_order_line_id,
                ]);
                $lgn->update([
                    "product_qty"=>$lgn->product_qty-$line->qty,
                    "product_qty_shipped"=>$line->qty+$lgn->product_qty_shipped,
                ]);



            }
        }
        $sequence->update([
            "next_number"=>$next+$sequence->increment,
        ]);
        }

        }else{

        $sequence=Sequence::where("origin","reception")->first();
        $type_move=TypeMove::where("name","mouvement fournisseur")->where("type","in")->first();

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
        $r=Reception::create([
            "name"=>$this->reception->name,
            "date"=>date("Y-m-d"),
            "date_shippement"=>date("Y-m-d"),
            "type"=>$type_move->type,
            "state"=>"Reçu",
            "company_id"=>$this->reception->company_id,
            "user_id"=>Auth::user()->id,
            "tier_id"=>$this->reception->tier_id,
            "purchase_order_id"=>$this->reception->purchase_order_id,
        ]);
        $this->reception->update([
            "name"=>$name_reception,
        ]);
        foreach($picking->lines as $line){
            $lgn=ReceptionLine::find($line->reception_line_id);
            if($line->qty == $lgn->product_qty){
                $lgn->update([
                    "state"=>"Reçu",
                    "reception_id"=>$r->id,
                ]);
            }else{
                $r->reception_lines()->create([
                    "product_qty_command"=>$lgn->product_qty_command,
                    "product_qty_shipped"=>$lgn->product_qty+$lgn->product_qty_shipped,
                    "product_qty"=>$line->qty,
                    "state"=>"Reçu",
                    "type"=>$type_move->type,
                    "company_id"=>$r->company_id,
                    "user_id"=>Auth::user()->id,
                    "product_id"=>$line->product_id,
                    "product_unity_id"=>$lgn->product_unity_id,
                    "warehouse_id"=>$lgn->warehouse_id,
                    "type_move_id"=>$type_move->id,
                    "purchase_order_line_id"=>$lgn->purchase_order_line_id,
                ]);
                $lgn->update([
                    "product_qty"=>$lgn->product_qty-$line->qty,
                    "product_qty_shipped"=>$line->qty+$lgn->product_qty_shipped,
                ]);



            }

        }
        $sequence->update([
            "next_number"=>$next+$sequence->increment,
        ]);
        }
        return redirect()->route('receptions.show',['reception'=>$this->reception->id]);
    }

    public function deleteline($i){
        unset($this->lignes[$i]);
    }
    public function createretour(){
        $type_move=TypeMove::where("name","mouvement fournisseur")->where("type","out")->first();
        $picking_id=Reception::create([
            "name"=>$this->reception->name."-Retour",
            "date"=>date("Y-m-d"),
            "date_shippement"=>date("Y-m-d"),
            "type"=>$type_move->type,
            "state"=>"assigned",
            "company_id"=>$this->reception->company_id,
            "user_id"=>Auth::user()->id,
            "tier_id"=>$this->reception->tier_id,
            "purchase_order_id"=>$this->reception->purchase_order_id,

        ]);
        foreach($this->lignes as $line){
            $lgn=ReceptionLine::find($line['move_line']);
        $picking_id->reception_lines()->create([
            "product_qty_command"=>0,
            "product_qty_shipped"=>0,
            "product_qty"=>$line['product_qty'],
            "state"=>"assigned",
            "type"=>$type_move->type,
            "company_id"=>$picking_id->company_id,
            "user_id"=>Auth::user()->id,
            "product_id"=>$lgn->product_id,
            "product_unity_id"=>$lgn->product_unity_id,
            "warehouse_id"=>$lgn->warehouse_id,
            "type_move_id"=>$type_move->id,
            "purchase_order_line_id"=>$lgn->purchase_order_line_id,
        ]);
    }
    return redirect()->route('retour.show',['retour'=>$picking_id]);
    }
    public function render()
    {


        return view('livewire.validate-qty');
    }
}
