<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Product;
use App\ReceptionLine;
use App\PurchaseOrder;
use App\Typemove;
use App\Sequence;
use Auth;
use App\Company;
use App\User;
use App\Tier;
use App\ListPrice;
use App\ReplishippementOrder;
class CronReplishippement extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alerte:stock';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $products=Product::where("type","stockable")->where("procurement_method","Automatique")->get();
        foreach($products as $product){
            $user=User::first();
            $qty=0;
            $move_type=TypeMove::where("name","mouvement fournisseur")->where("type","in")->first();

            $moves=ReceptionLine::where("product_id",$product->id)->where("type_move_id",$move_type->id)->whereIn('state',array('confirmed','assigned','Reçu'))->get();

            foreach($moves as $move){

                $qty=$qty+$move->product_qty;
            }
            $move_type=TypeMove::where("name","mouvement fournisseur")->where("type","out")->first();

            $moves=ReceptionLine::where("product_id",$product->id)->where("type_move_id",$move_type->id)->whereIn('state',array('assigned','Reçu'))->get();

            foreach($moves as $move){

                $qty=$qty-$move->product_qty;
            }

            if($qty<$product->alerte_stock){
                if(count($product->suppliers)!=0){
                    $dem_reap=ReplishippementOrder::where('product_id',$product->id)->get();
                    foreach($dem_reap as $dmme){
                        $dmme->delete();
                    }

                    $qtyy=$product->optimal_stock-$qty;
                    $filtered=$product->suppliers->where('qtt_min','<=', $qtyy);


                    if(count($filtered)>0){
                        $supp_id=Tier::find($filtered->first()->tier_id);
                        $supplier=$filtered->first();
                         $pp=$supp_id->list_price_id;


                    $company=Company::first();
                    $sequence=Sequence::where("origin","orders")->first();

                    $name_devis=$sequence->name.'/';

                    if($sequence->year==1){
                        $year=date('Y');
                        $name_devis.=$year.'/';
                    }
                    if($sequence->month){
                        $month=date('m');
                        $name_devis.=$month.'/';
                    }
                    if($sequence->day){
                        $day=date('d');
                        $name_devis.=$day.'/';
                    }
                    $next=$sequence->next_number;
                    $numb="";
                    for($j=strlen($next);$j<$sequence->remplissage;$j++){
                        $numb.="0";

                    }
                    $name_devis.=$numb.$next;
                    $order=$company->purchase_orders()->create([
                        "user_id"=>$user->id,
                        "name"=>$name_devis,
                        "tier_id"=>$supp_id->id,
                        "date"=>date('Y-m-d'),
                        "date_shippement"=>date('Y-m-d', strtotime(' + '.$supplier->delai.' days')),
                        "ammount_ht"=>$supplier->price*$qtyy,
                        "ammount_tax"=>$supplier->price*$qtyy*$product->taxe->taux/100,
                        "ammount_total"=>($supplier->price*$qtyy)+($supplier->price*$qtyy*$product->taxe->taux/100),
                        "list_price_id"=>$pp,
                        "condition_reglement"=>15,
                    ]);


                        $order->order_lines()->create(
                            [
                                "company_id"=>$order->company->id,
                                "product_qty"=>$qtyy,
                                "price_unit"=>$supplier->price,
                                "amount"=>$qtyy*$supplier->price,
                                "remise"=>0,
                                "state"=>"brouillon",
                                "user_id"=>$user->id,
                                "product_id"=>$product->id,
                                "unity_id"=>$product->unity_id,
                                "warehouse_id"=>$product->warehouse_id,
                                "taxe_id"=>$product->taxe_id

                            ]
                            );

                    $sequence->update([
                        "next_number"=>$next+$sequence->increment,
                    ]);
                $type_move=TypeMove::where("name","mouvement fournisseur")->where("type","in")->first();
                $reception=new ReceptionLine;
                $reception_id=$reception->create([
                        "product_qty_command"=>$qtyy,
                        "product_qty_shipped"=>0,
                        "product_qty"=>$qtyy,
                        "state"=>"confirmed",
                        "type"=>$type_move->type,
                        "company_id"=>$order->company_id,
                        "user_id"=>$user->id,
                        "product_id"=>$product->id,
                        "product_unity_id"=>$product->unity_id,
                        "warehouse_id"=>$product->warehouse_id,
                        "type_move_id"=>$type_move->id,

                    ]);

                    $sequence=Sequence::where("origin","replishippement")->first();

                    $name_devis=$sequence->name.'/';

                    if($sequence->year==1){
                        $year=date('Y');
                        $name_devis.=$year.'/';
                    }
                    if($sequence->month){
                        $month=date('m');
                        $name_devis.=$month.'/';
                    }
                    if($sequence->day){
                        $day=date('d');
                        $name_devis.=$day.'/';
                    }
                    $next=$sequence->next_number;
                    $numb="";
                    for($j=strlen($next);$j<$sequence->remplissage;$j++){
                        $numb.="0";

                    }
                    $name_devis.=$numb.$next;
                $procurement=new ReplishippementOrder;
                $procurement->create([
                    "user_id"=>$user->id,
                    "purchase_order_id"=>$order->id,
                    "reception_line_id"=>$reception_id->id,
                    "product_id"=>$product->id,
                    "company_id"=>$order->company_id,
                    "warehouse_id"=>$product->warehouse_id,
                    "state"=>"executé",
                    "product_qty"=>$qtyy,
                    "date"=>date('Y-m-d'),
                    "name"=>$name_devis,
                ]);
                $sequence->update([
                    "next_number"=>$sequence->next_number+$sequence->increment,
                ]);
                    }
                    else{
                        $sequence=Sequence::where("origin","replishippement")->first();

            $name_devis=$sequence->name.'/';

            if($sequence->year==1){
                $year=date('Y');
                $name_devis.=$year.'/';
            }
            if($sequence->month){
                $month=date('m');
                $name_devis.=$month.'/';
            }
            if($sequence->day){
                $day=date('d');
                $name_devis.=$day.'/';
            }
            $next=$sequence->next_number;
            $numb="";
            for($j=strlen($next);$j<$sequence->remplissage;$j++){
                $numb.="0";

            }
            $name_devis.=$numb.$next;
            $company=Company::first();
            $procurement=new ReplishippementOrder;
            $procurement->create([
                "user_id"=>$user->id,

                "message"=>"Les conditions de vos fournisseurs ne sont pas satisfaite",
                "product_id"=>$product->id,
                "company_id"=>$company->id,
                "warehouse_id"=>$product->warehouse_id,
                "state"=>"En exception",
                "product_qty"=>$qtyy,
                "date"=>date('Y-m-d'),
                "name"=>$name_devis,
            ]);
            $sequence->update([
                "next_number"=>$sequence->next_number+$sequence->increment,
            ]);

                    }





            }else{

                $dem_reap=ReplishippementOrder::where('product_id',$product->id)->get();
                foreach($dem_reap as $dmme){
                    $dmme->delete();
                }
                $sequence=Sequence::where("origin","replishippement")->first();

                $name_devis=$sequence->name.'/';

                if($sequence->year==1){
                    $year=date('Y');
                    $name_devis.=$year.'/';
                }
                if($sequence->month){
                    $month=date('m');
                    $name_devis.=$month.'/';
                }
                if($sequence->day){
                    $day=date('d');
                    $name_devis.=$day.'/';
                }
                $next=$sequence->next_number;
                $numb="";
                for($j=strlen($next);$j<$sequence->remplissage;$j++){
                    $numb.="0";

                }
                $name_devis.=$numb.$next;
                $company=Company::first();
                $qtyy=$product->optimal_stock-$qty;
                $procurement=new ReplishippementOrder;
                $procurement->create([
                    "user_id"=>$user->id,

                    "message"=>"Aucun fournisseur n'est défini",
                    "product_id"=>$product->id,
                    "company_id"=>$company->id,
                    "warehouse_id"=>$product->warehouse_id,
                    "state"=>"En exception",
                    "product_qty"=>$qtyy,
                    "date"=>date('Y-m-d'),
                    "name"=>$name_devis,
                ]);
                $sequence->update([
                    "next_number"=>$sequence->next_number+$sequence->increment,
                ]);

            }
        }
        }


            }
}
