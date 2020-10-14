<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryLine extends Model
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
    public function inventory()
    {
        return $this->belongsTo('App\Inventory');
    }
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
    public function unity()
    {
        return $this->belongsTo('App\ProductUnity');
    }
    public function warehouse()
    {
        return $this->belongsTo('App\Warehouse');
    }
}
