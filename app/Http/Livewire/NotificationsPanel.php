<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Notifications;
use App\Tier;
use App\Taxe;
use App\Warehouse;
use App\ProductUnity;
use App\CategoryProduct;
use App\Currency;
use App\ListPrice;
use App\product;
use App\ReceptionLine;
use App\Sequence;
use App\TypeMove;
use App\ReplishippementOrder;
use App\Invoice;

use Illuminate\Support\Facades\Storage;


class NotificationsPanel extends Component
{
    public $notifications;
    public $number=0;
    public function mount()
    {
        $notifs=Notifications::all();
        foreach($notifs as $notif){
            $notif->delete();
        }
        $invoices=Invoice::where('date_due','<=',date('Y-m-d'))->where('state','Ouverte')->get();
        foreach($invoices as $invoice){
            $invoice->update([
                "state"=>"En échéance",
            ]);
        }
        $BDtaxes = Taxe::all();
        $this->Notif($BDtaxes,'Vous n\'avez aucune taxe.' ,'../taxes/create','hand-holding-usd');
        $BDwarehouse = Warehouse::all();
        $this->Notif($BDwarehouse,'Vous n\'avez aucun entrepôt.' ,'../warehouses/create','warehouse');
        $BDProductUnity = ProductUnity::all();
        $this->Notif($BDProductUnity,'Vous n\'avez aucune unité de mesure.' ,'../unityProducts/create','balance-scale-right');
        $BDProductCategory = CategoryProduct::all();
        $this->Notif($BDProductCategory,'Vous n\'avez aucune catégorie de produit.' ,'../categoryProducts/create','cube');
        $BDCurrency = Currency::all();
        $this->Notif($BDCurrency,'Vous n\'avez aucune devise.' ,'../currencies/create','money-bill-wave');
        $BDListPrice = ListPrice::all();
        $this->Notif($BDListPrice,'Vous n\'avez aucune liste de prix.' ,'../listPrices/create','file-invoice-dollar');

        $products=Product::where('type','stockable')->get();
        foreach($products as $product){
            $qty=0;
            $move_type=TypeMove::where("name","mouvement fournisseur")->where("type","in")->first();
            $moves=ReceptionLine::where("product_id",$product->id)->where("type_move_id",$move_type->id)->whereIn('state',array('confirmed','assigned','Reçu'))->get();
            foreach($moves as $move){

                $qty=$qty+$move->product_qty;
            }
            $move_type=TypeMove::where("name","mouvement fournisseur")->where("type","out")->first();
            $moves=ReceptionLine::where("product_id",$product->id)->where("type_move_id",$move_type->id)->whereIn('state',array('assigned','Livré'))->get();
            foreach($moves as $move){
                $qty=$qty-$move->product_qty;
            }
            if($qty<$product->alerte_stock){
                $BDAlerteStock=[];
                $this->Notif($BDAlerteStock,'Alerte de stock < '.$product->name.' >' ,'../products/'.$product->id.'','exclamation-triangle');
            }else{
                $BDAlerteStock=[$product];
                $this->Notif($BDAlerteStock,'Alerte de stock < '.$product->name.' >' ,'../products/'.$product->id.'','exclamation-triangle');
            }
        }
        $reps=ReplishippementOrder::where('state','En exception')->get();


        foreach($reps as $rep){
        $BDException =[];
        $this->Notif($BDException,$rep->name.' en exception'   ,'../replenishment/'.$rep->id,'exclamation-triangle');
        }
        $BDnotifications = Notifications::all();
        $this->notifications = $BDnotifications;
        if ($BDnotifications !== false) {
            $this->number = count($BDnotifications);
        }
    }
    public function Notif($value,$content,$link,$icon)
    {
        if (count($value)!==0)
        {
            $notif = Notifications::where('content', 'like', '%'.$content.'%');
            $notif->delete();
        }
        if (count($value)==0)
        {
            $notif = Notifications::where('content', 'like', '%'.$content.'%')->first();
            if (!$notif)
            {
                $notif = Notifications::create(
                    [
                        'content' => $content,
                        'link' => $link,
                        'icon' => $icon,
                    ]
                    );
            }
        }
    }
    public function render()
    {
        return view('livewire.notifications-panel');
    }
}
