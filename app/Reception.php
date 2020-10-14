<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Reception extends Model
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
    public function tier()
    {
        return $this->belongsTo('App\Tier');
    }
    public function purchase_order()
    {
        return $this->belongsTo('App\PurchaseOrder');
    }
    public function reception_lines()
    {
        return $this->hasMany('App\ReceptionLine');
    }
    public function partial_picking()
    {
        return $this->hasMany('App\PartialPicking');
    }
    public static function searchRetourByName($name):array
    {
        $receptions=self::where("type","out")->get();
        if($name==""){
            return $receptions->all();
        }
        return collect($receptions)
        ->filter( function($receptions) use($name){
                return Str::contains(strtolower($receptions['name']),strtolower($name));
        } )->all();
    }
    public static function searchByName($name):array
    {
        $receptions=self::where("type","in")->get();
        if($name==""){
            return $receptions->all();
        }
        return collect($receptions)
        ->filter( function($receptions) use($name){
                return Str::contains(strtolower($receptions['name']),strtolower($name));
        } )->all();
    }
    public static function searchByPurchaseName($name,$id_order):array
    {

        $receptions=self::where('purchase_order_id',$id_order)->where("type","in")->get()->all();
        return $receptions;
    }
}
