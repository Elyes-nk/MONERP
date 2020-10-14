<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Warehouse extends Model
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
    public function products(){
        return $this->hasMany('App\product');
    }
    public function moves(){
        return $this->hasMany('App\ReceptionLine');
    }
    public function orders(){
        return $this->hasMany('App\PurchaseOrderLine');
    }
    public static function searchByName($name):array
    {
        $warehouses=self::all();
        if($name==""){
            return $warehouses->all();
        }
        return collect($warehouses)
        ->filter( function($warehouses) use($name){
                return Str::contains(strtolower($warehouses['name']),strtolower($name));
        } )->all();
    }
}
