<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PurchaseOrder;
use App\PurchaseOrderLine;
use App\Company;
use App\Tier;
use App\ListPrice;
use App\ProductUnity;
use App\Taxe;
use App\CategoryProduct;
use Auth;
use App\Sequence;
use App\TypeMove;
use App\Product;
use App\Invoice;
class DevisController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('sequences');
        $this->middleware('products');
        $this->middleware('tiers');

    }

    public function index()
    {
        $devis=PurchaseOrder::where("state","brouillon")->get();

        return view('devis.index',compact('devis'));
    }
    public function create(PurchaseOrder $purchase_order)
    {
        $purchase_order=new PurchaseOrder();
        $tiers=Tier::all();
        $listprices=ListPrice::all();
        return view('devis.create',compact('tiers','listprices','purchase_order'));
    }
    
    public function show($id)
    {
        $tiers = Tier::All();
        $purchase_order = PurchaseOrder::find($id);
        if(! $purchase_order)
        {
            return redirect()->route('devis.index');
        }
        $id_next=PurchaseOrder::where('id','<',$id)->where('state','brouillon')->orderBy('id','desc')->first();
        if(!$id_next){
            $id_next = PurchaseOrder::where('state','brouillon')->first();
        }
        $id_previous=PurchaseOrder::where('id','>',$id)->where('state','brouillon')->first();
        if(!$id_previous){
            $id_previous = PurchaseOrder::where('state','brouillon')->first();
        }
        $Taxes = Taxe::All();
        $Product_unities = ProductUnity::All();
        $Category_products = CategoryProduct::All();
        $list_prices = ListPrice::All();
        return view('devis.show', compact('purchase_order','tiers','id_next','id_previous','Taxes','Product_unities','Category_products','list_prices'));

    }

    public function edit(PurchaseOrder $purchase_order,$id)
    {
        $purchase_order=PurchaseOrder::find($id);
        if(! $purchase_order)
        {
            return redirect()->route('devis.index');
        }
        return view('devis.edit', compact('purchase_order'));
    }

    
    public function destroy(PurchaseOrder $purchase_order,$id)
    {
        $purchase_order=PurchaseOrder::find($id);
        $purchase_order->delete();
        return redirect()->route('devis.index');
    }

    public function pdf(PurchaseOrder $purchase_order, $id)
    {
        $purchase_order=PurchaseOrder::find($id);
        $tiers = Tier::All();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML(view('devis.pdf', compact('purchase_order','tiers')));
        return $pdf->stream();
    }

    public function confirm_purchase($id){
        $purchase_order=PurchaseOrder::find($id);
        $purchase_order->update([
            "state"=>"confirmed",
        ]);
        if($purchase_order->procurement_orders->first()){
            $procurement_order=$purchase_order->procurement_orders->first();
            $procurement_order->reception_line->delete();
        }
        foreach($purchase_order->order_lines as $line){
            $line->update([
                "state"=>"confirmed"
            ]);
            $prod=Product::find($line->product_id);
                $prod->update([
                    "cump"=>(($prod->cump*$prod->physical_stock)+($line->price_unit*$line->product_qty))/($line->product_qty+$prod->physical_stock),
                ]);
        }
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
        $reception=$purchase_order->receptions()->create([
            "name"=>$name_reception,
            "date"=>$purchase_order->date,
            "date_shippement"=>$purchase_order->date_shippement,
            "type"=>$type_move->type,
            "state"=>"assigned",
            "company_id"=>$purchase_order->company_id,
            "user_id"=>Auth::user()->id,
            "tier_id"=>$purchase_order->tier_id,
        ]);
        foreach($purchase_order->order_lines as $line){
            $reception->reception_lines()->create([
                "product_qty_command"=>$line->product_qty,
                "product_qty_shipped"=>0,
                "product_qty"=>$line->product_qty,
                "state"=>"assigned",
                "type"=>$type_move->type,
                "company_id"=>$purchase_order->company_id,
                "user_id"=>Auth::user()->id,
                "product_id"=>$line->product_id,
                "product_unity_id"=>$line->unity_id,
                "warehouse_id"=>$line->warehouse_id,
                "type_move_id"=>$type_move->id,
                "purchase_order_line_id"=>$line->id,
            ]);
        }
        $sequence->update([
            "next_number"=>$next+$sequence->increment,
        ]);
        $sequence=Sequence::where("origin","invoice")->first();


        $name_invoice=$sequence->name.'/';

        if($sequence->year==1){
            $year=date('Y');
            $name_invoice.=$year.'/';
        }
        if($sequence->month){
            $month=date('m');
            $name_invoice.=$month.'/';
        }
        if($sequence->day){
            $day=date('d');
            $name_invoice.=$day.'/';
        }
        $next=$sequence->next_number;
        $numb="";
        for($j=strlen($next);$j<$sequence->remplissage;$j++){
            $numb.="0";

        }


        $name_invoice.=$numb.$next;
        $invoice=Invoice::create([
            "name"=>$name_invoice,
            "type"=>"in",
            "date"=>$purchase_order->date,
            "date_due"=>date("Y-m-d",strtotime($purchase_order->date."+".$purchase_order->condition_reglement." days")),
            "ammount_ht"=>$purchase_order->ammount_ht,
            "ammount_tax"=>$purchase_order->ammount_tax,
            "ammount_total"=>$purchase_order->ammount_total,
            "tier_id"=>$purchase_order->tier_id,
            "currency_id"=>$purchase_order->list_price->currency_id,
            "company_id"=>$purchase_order->company_id,
            "user_id"=>Auth::user()->id,
            "purchase_order_id"=>$purchase_order->id,
            "reception_id"=>$purchase_order->receptions->first()->id,
            "remise"=>$purchase_order->remise,
        ]);
        foreach($purchase_order->order_lines as $line){
            $invoice->invoice_lines()->create([
                "product_qty"=>$line->product_qty,
                "price_unit"=>$line->price_unit,
                "amount"=>$line->amount,
                "remise"=>0,
                "company_id"=>$line->company_id,

                "user_id"=>Auth::user()->id,
                "product_id"=>$line->product_id,
                "product_unity_id"=>$line->unity_id,
                "purchase_order_line_id"=>$line->id,
                "taxe_id"=>$line->taxe_id,
            ]);
        }
            $sequence->update([
                "next_number"=>$next+$sequence->increment,
            ]);
        return redirect()->route('commandes.show',['commande'=>$purchase_order->id]);
    }
    public function cancel_order($id){
        dd($id);
    }
}
