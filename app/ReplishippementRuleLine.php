<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReplishippementRuleLine extends Model
{
    protected $guarded=[];
    public function company(){
        return $this->belongsTo('App\Company');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function replishippement(){
        return $this->belongsTo('App\ReplishippementRule');
    }
}
