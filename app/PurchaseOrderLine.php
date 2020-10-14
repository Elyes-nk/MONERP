<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderLine extends Model
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
    public function product()
    {
        return $this->belongsTo('App\Product');
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
    public function order()
    {
        return $this->belongsTo('App\PurchaseOrder');
    }
    public function reception_line()
    {
        return $this->hasMany('App\ReceptionLine');
    }
}
