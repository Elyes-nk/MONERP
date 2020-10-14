<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    protected $guarded = [];
    public function sequences()
    {
        return $this->hasMany('App\Sequence');
    }
    public function users()
    {
        return $this->hasMany('App\User');
    }
    public function currencies()
    {
        return $this->hasMany('App\Currency');
    }
    public function unities()
    {
        return $this->hasMany('App\ProductUnity');
    }
    public function categories()
    {
        return $this->hasMany('App\CategoryProduct');
    }
    public function warehouses()
    {
        return $this->hasMany('App\Warehouse');
    }
    public function list_prices()
    {
        return $this->hasMany('App\ListPrice');
    }
    public function taxes()
    {
        return $this->hasMany('App\Taxe');
    }
    public function products()
    {
        return $this->hasMany('App\Product');
    }
    public function tiers()
    {
        return $this->hasMany('App\Tier');
    }
    public function purchase_orders()
    {
        return $this->hasMany('App\PurchaseOrder');
    }
    public function type_moves()
    {
        return $this->hasMany('App\TypeMove');
    }
    public function receptions()
    {
        return $this->hasMany('App\Reception');
    }
    public function invoices()
    {
        return $this->hasMany('App\Invoice');
    }
    public function inventories()
    {
        return $this->hasMany('App\Inventory');
    }
    public function currency()
    {
        return $this->belongsTo('App\Currency');
    }
}
