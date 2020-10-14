<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReplishippementOrder extends Model
{
    protected $guarded = [];
    public function order(){
        return $this->belongsTo('App\PurchaseOrder');
    }
    public function product(){
        return $this->belongsTo('App\Product');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function Company(){
        return $this->belongsTo('App\Company');
    }
    public function warehouse(){
        return $this->belongsTo('App\Warehouse');

    }
    public function reception_line(){
        return $this->belongsTo('App\ReceptionLine');
    }
}
