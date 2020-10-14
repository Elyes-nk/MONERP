<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class ListPrice extends Model
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
    public function currency()
    {
        return $this->belongsTo('App\Currency');
    }
    public function tiers(){
        return $this->belongsTo('App\Tier');
    }
    public function orders(){
        return $this->hasMany('App\Tier');
    }
    /* The searchs functions ************************************* ---*/

    public static function searchByName($name):array
    {
        $listPrices=self::all();
        if($name==""){
            return $listPrices->all();
        }
        return collect($listPrices)
        ->filter( function($listPrices) use($name){
                return Str::contains(strtolower($listPrices['name']),strtolower($name));
        } )->all();
    }
}
