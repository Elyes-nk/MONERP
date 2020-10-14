<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Tier extends Model
{
    protected $guarded = [];

    public function purchase_orders()
    {
        return $this->hasMany('App\PurchaseOrder');
    }
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
    public function invoices()
    {
        return $this->hasMany('App\Invoice');
    }
    public function receptions()
    {
        return $this->hasMany('App\Reception');
    }
    public function orders()
    {
        return $this->hasMany('App\PurchaseOrder');
    }
    public function products()
    {
        return $this->hasMany('App\ProductSupllierRel');
    }
    public static function searchByName($name):array
    {
        $tiers=self::all();
        if($name==""){
            return $tiers->all();
        }
        return collect($tiers)
        ->filter( function($tiers) use($name){
                return Str::contains(strtolower($tiers['name']),strtolower($name));
        } )->all();
    }
}
