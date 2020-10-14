<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $guarded=[];
    public function tier(){
        return $this->belongsTo('App\Tier');
    }
    public function invoice(){
        return $this->belongsTo('App\Invoice');
    }
    public function company(){
        return $this->belongsTo('App\Company');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
