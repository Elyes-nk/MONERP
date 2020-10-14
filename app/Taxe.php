<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Taxe extends Model
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
    public function products()
    {
        return $this->hasMany('App\Product');
    }
    public function orders()
    {
        return $this->hasMany('App\PurchaseOrderLine');
    }
    public function invoices()
    {
        return $this->hasMany('App\InvoiceLine');
    }
    public static function searchByName($name):array
    {
        $taxes=self::all();
        if($name==""){
            return $taxes->all();
        }
        return collect($taxes)
        ->filter( function($taxes) use($name){
                return Str::contains(strtolower($taxes['name']),strtolower($name));
        } )->all();
    }
}
