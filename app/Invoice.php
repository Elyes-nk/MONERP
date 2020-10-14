<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
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
    public function tier()
    {
        return $this->belongsTo('App\Tier');
    }
    public function list_price()
    {
        return $this->belongsTo('App\ListPrice');
    }
    public function currency()
    {
        return $this->belongsTo('App\Currency');
    }
    public function purchase_order()
    {
        return $this->belongsTo('App\PurchaseOrder');
    }
    public function reception()
    {
        return $this->belongsTo('App\Reception');
    }
    public function invoice_lines(){
        return $this->hasMany("App\InvoiceLine");
    }
    public function vouchers(){
        return $this->hasMany("App\Paiement");
    }
}
