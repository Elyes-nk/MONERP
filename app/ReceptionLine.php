<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceptionLine extends Model
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
    public function unity()
    {
        return $this->belongsTo('App\ProductUnity');
    }
    public function warehouse()
    {
        return $this->belongsTo('App\Warehouse');
    }
    public function typemove()
    {
        return $this->belongsTo('App\TypeMove');
    }
    public function purchase_order_line()
    {
        return $this->belongsTo('App\PurchaseOrderLine');
    }
    public function reception()
    {
        return $this->belongsTo('App\Reception');
    }
    public function partial_line(){
        return $this->hasMany('App\PartialPickingLine');
    }
}
