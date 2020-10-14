<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSupplierRel extends Model
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
    public function tier()
    {
        return $this->belongsTo('App\Tier');
    }
}
