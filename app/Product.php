<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Product extends Model
{
    /*protected $fillable=['name','ref','sale_price','standard_price',
    'alerte_stock','optimal_stock','physical_stock','virtual_stock',
    'procurement_method','product_unity_id','type','user_id',
    'taxe_id','category_product_id','cump']; */
    //c'est mieux avec guarded
    protected $guarded = [];

    public function company()
    {
        return $this->belongsTo('App\Company');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function category()
    {
        return $this->belongsTo('App\CategoryProduct');
    }
    public function taxe()
    {
        return $this->belongsTo('App\Taxe');
    }
    public function unity()
    {
        return $this->belongsTo('App\ProductUnity');
    }
    public function warehouse()
    {
        return $this->belongsTo('App\Warehouse');
    }
    public function suppliers(){
        return $this->hasMany('App\ProductSupplierRel')->orderBy("price","asc")->orderBy("delai","desc");

    }
    public function moves(){
        return $this->hasMany('App\ReceptionLine');
    }
    public function procurement_rules(){
        return $this->hasMany('App\ReplishippementRule');
    }
    public function procurements(){
        return $this->hasMany('App\ReplishippementOrder');
    }
    /* The searchs functions ************************************* ---*/
    public static function searchByName($name):array
    {
        $products=self::all();
        if($name==""){
            return $products->all();
        }
        return collect($products)
        ->filter( function($products) use($name){
                return Str::contains(strtolower($products['name']),strtolower($name));
        } )->all();
    }
}
