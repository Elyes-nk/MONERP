<?php

namespace App;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $guarded = [];

    public function company()
    {
        return $this->belongsTo('App\Company');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function list_price()
    {
        return $this->belongsTo('App\ListPrice');
    }
    public function tier()
    {
        return $this->belongsTo('App\Tier');
    }

    public function order_lines()
    {
        return $this->hasMany('App\PurchaseOrderLine');
    }
    public function receptions()
    {
        return $this->hasMany('App\Reception');
    }

    public function invoice(){
        return $this->hasMany('App\Invoice');
    }

    public function procurement_orders()
    {
        return $this->hasMany('App\ReplishippementOrder');
    }

    public static function searchcommandesByName($name):array
    {
        $commandes=self::where("state","confirmed")->get();
        if($name==""){
            return $commandes->all();
        }
        return collect($commandes)
        ->filter( function($commandes) use($name){
                return Str::contains(strtolower($commandes['name']),strtolower($name));
        } )->all();
    }

    public static function searchdevisByName($name):array
    {
        $devis=self::where("state","brouillon")->get();
        if($name==""){
            return $devis->all();
        }
        return collect($devis)
        ->filter( function($devis) use($name){
                return Str::contains(strtolower($devis['name']),strtolower($name));
        } )->all();
    }
}
