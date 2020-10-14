<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Reception;
use App\Tier;
use App\Product;
use App\PurchaseOrderLine;
use App\ListPrice;
use App\ProductUnity;
use App\Taxe;
use App\CategoryProduct;

class ReceptionsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('sequences');
    }

    public function show($id)
    {
        $reception = Reception::find($id);
        if(! $reception)
        {
            return redirect()->route('receptions.index');
        }
        $id_next=Reception::where('id','<',$id)->where('type',"in")->orderBy('id','desc')->first();
        if(!$id_next){
            $id_next = Reception::where('type',"in")->first();
        }
        $id_previous= Reception::where('id','>',$id)->where('type',"in")->first();
        if(!$id_previous){
            $id_previous = Reception::where('type',"in")->first();
        }
        
        $Taxes = Taxe::All();
        $Product_unities = ProductUnity::All();
        $Category_products = CategoryProduct::All();
        $list_prices = ListPrice::All();
        return view('receptions.show',compact('reception','id_next','id_previous','Taxes','Product_unities','Category_products','list_prices'));
    }

    public function edit($id)
    {
        $reception=Reception::findOrFail($id);
         if(! $reception)
        {
            return redirect()->route('receptions.index');
        }
        $tiers = Tier::all();
        return view('receptions.edit', compact('reception','tiers'));
    }

    public function update(Request $request,$id)
    {
        /*$purchase_order->update($this->ValidateData()); */
        $company=Company::first();
        $this->validate($request,[



    ]);
        $reception=Reception::findOrFail($id) ;
        $reception->update([


        ]);
        return redirect()->route('receptions.show',["reception"=>$reception->id]);
    }



    public function destroy($id)
    {
        $reception=Reception::find($id);
        foreach($reception->reception_lines as $line){

            foreach($line->partial_line as $lg){
                $lg->delete();
            }
            $line->delete();

        }
        foreach($reception->partial_picking as $line){
            $line->delete();
        }
        $reception->delete();
        session()->flash('message','La réception a était supprimée avec succès !');
        return redirect()->route('receptions.index');
    }

    public function pdf(Reception $reception, $id)
    {
        //$reception=Reception::find($id);
        $reception = Reception::with(['purchase_order.order_lines.product','tier'])->findOrFail($id);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML(view('receptions.pdf', compact('reception')));
        return $pdf->stream();
    }

    public function index(){
        $receptions=Reception::all();

        return view('receptions.index',compact('receptions'));
    }
    public function receive(Request $request,$id){
        $reception=Reception::find($id);
        $i=0;
        foreach ($reception->reception_lines as $line){

        $name="qty".$i;
        $this->validate($request,[
            "name"=>"required|min:0"
        ]);
        $i+=1;
    }
    }
    public function cancel_receipt($id){
        $reception=Reception::find($id);
        foreach($reception->reception_lines as $line){

            $line->update([
                "state"=>"Annulé",
            ]);

        }
        $reception->update([
            "state"=>"Annulé",
        ]);
        return redirect()->route('receptions.show',['reception'=>$id]);
    }
}
