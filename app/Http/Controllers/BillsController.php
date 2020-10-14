<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PurchaseOrder;
use App\Tier;
use App\ListPrice;
use App\invoice;
use App\ProductUnity;
use App\Taxe;
use App\CategoryProduct;
class BillsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('sequences');
    }
    public function index()
    {
        //$bills=PurchaseOrder::where('')->get()->all();
        $bills=PurchaseOrder::all();
        return view('bills.index',compact('bills'));
    }
    public function show($id)
    {
        $bill=Invoice::find($id);
        if(! $bill)
        {
            return redirect()->route('bills.index');
        }
        $tiers=Tier::all();
        $list_prices=ListPrice::all();
        $id_next=invoice::where('id','<',$id)->orderBy('id','desc')->first();
        if(!$id_next){
            $id_next = Invoice::first();
        }
        $id_previous=Invoice::where('id','>',$id)->first();
        if(!$id_previous){
            $id_previous = Invoice::first();
        }
        $Taxes = Taxe::All();
        $Product_unities = ProductUnity::All();
        $Category_products = CategoryProduct::All();
        return view('bills.show',compact('bill','tiers','id_next','id_previous','Taxes','Product_unities','Category_products','list_prices'));
    }
    public function destroy(PurchaseOrder $bill )
    {
       $bill->delete();
        return redirect()->route('bills.index');
    }

    public function validatebill($id){
        $bill=Invoice::find($id);
        $bill->update([
        "state"=>"Ouverte",
        ]);
        $tiers=Tier::all();
        $listprices=ListPrice::all();
        return redirect()->route('bills.show',['bill'=>$id]);
    }
    public function pdf(PurchaseOrder $bill, $id)
    {
        $bill=Invoice::find($id);
        $tiers=Tier::all();
        $listprices=ListPrice::all();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML(view('bills.pdf', compact('bill','tiers','listprices')));
        return $pdf->stream();
    }

    public function bill_cancel($id){
        $bill=Invoice::find($id);
        $purchase_order=PurchaseOrder::find($bill->purchase_order_id);
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
        return redirect()->route('bills.show',["bill"=>$id]);
    }
}
