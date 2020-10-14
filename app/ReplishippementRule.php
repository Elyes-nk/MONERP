<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReplishippementRule extends Model
{
    protected $guarded=[];
    public function lines(){
        return $this->hasMany('App\ReplishippementRuleLine')->orderBy("date","asc");
    }
    public function company(){
        return $this->belongsTo('App\Company');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function product(){
        return $this->belongsTo('App\Product');
    }
    public function warehouse(){
        return $this->belongsTo('App\Warehouse');
    }
}
