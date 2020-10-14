<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PurchaseOrder;
use App\Tier;
use App\ListPrice;
use App\ProductUnity;
use App\Taxe;
use App\CategoryProduct;
class CommandesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('sequences');
    }
    public function index()
    {
        $commandes=PurchaseOrder::where('state','confirmed')->get()->all();
        return view('commandes.index',compact('commandes'));
    }

    public function show($id)
    {
        $purchase_order=PurchaseOrder::find($id);
        if(! $purchase_order)
        {
            return redirect()->route('commandes.index');
        }
        $tiers=Tier::all();
        $id_next=PurchaseOrder::where('id','<',$id)->where('state','<>','brouillon')->orderBy('id','desc')->first();
        if(!$id_next){
            $id_next = PurchaseOrder::where('state','<>','brouillon')->first();
        }
        $id_previous=PurchaseOrder::where('id','>',$id)->where('state','<>','brouillon')->first();
        if(!$id_previous){
            $id_previous = PurchaseOrder::where('state','<>','brouillon')->first();
        }
        $Taxes = Taxe::All();
        $Product_unities = ProductUnity::All();
        $Category_products = CategoryProduct::All();
        $list_prices = ListPrice::All();
        return view('commandes.show',compact('purchase_order','tiers','listprices','id_next','id_previous','Taxes','Product_unities','Category_products','list_prices'));
    }

    public function destroy(PurchaseOrder $purchase_order,$id)
    {
        $purchase_order=PurchaseOrder::find($id);


        foreach($purchase_order->invoice as $line){


            foreach($line->invoice_lines as $lg){
                $lg->delete();
            }
            $line->delete();
        }
        foreach($purchase_order->receptions as $line){



            $line->delete();
        }
        foreach($line->reception_lines as $lg){
            $lg->delete();
        }
        foreach($purchase_order->order_lines as $line){

            $line->delete();
        }

        $purchase_order->delete();
        return redirect()->route('commandes.index');
    }

    public function pdf(PurchaseOrder $purchase_order, $id)
    {
        $purchase_order=PurchaseOrder::find($id);
        $tiers = Tier::All();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML(view('commandes.pdf', compact('purchase_order','tiers')));
        return $pdf->stream();
    }


    public function cancel_order($id){
        $purchase_order=PurchaseOrder::find($id);
        $purchase_order->update([
            "state"=>"Annulé"
        ]);
        foreach($purchase_order->order_lines as $line){

            $line->update([
                "state"=>"Annulé"
            ]);
        }
        foreach($purchase_order->receptions as $line){

            $line->update([
                "state"=>"Annulé"
            ]);
            foreach($line->reception_lines as $lg){
                $lg->update([
                    "state"=>"Annulé"
                ]);
            }
        }
        foreach($purchase_order->invoice as $line){

            $line->update([
                "state"=>"Annulé"
            ]);
            foreach($line->invoice_lines as $lg){
                $lg->update([
                    "state"=>"Annulé"
                ]);
            }
        }
        return redirect()->route('commandes.show',["commande"=>$id]);
    }


}
