<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceLine extends Model
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
    public function Taxe()
    {
        return $this->belongsTo('App\Taxe');
    }
    public function unity()
    {
        return $this->belongsTo('App\ProductUnity');
    }

    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }
    public function purchase_order_line()
    {
        return $this->belongsTo('App\PurchaseOrderLine');
    }

    public function reception_line()
    {
        return $this->belongsTo('App\ReceptionLine');
    }
}
