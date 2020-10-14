<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Currency extends Model
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
    public function currency_lines()
    {
        return $this->hasMany('App\CurrencyLines');
    }
    public function listes()
    {
        return $this->hasMany('App\Listprice');
    }
    public function companies()
    {
        return $this->hasMany('App\Company');
    }
    /* customm fucntions*/
    public static function searchByName($name):array
    {
        $currencies=self::all();
        if($name==""){
            return $currencies->all();
        }
        return collect($currencies)
        ->filter( function($currencies) use($name){
                return Str::contains(strtolower($currencies['name']),strtolower($name));
        } )->all();
    }

}
