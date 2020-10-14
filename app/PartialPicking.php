<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartialPicking extends Model
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
    public function reception()
    {
        return $this->belongsTo('App\Reception');
    }
    public function lines()
    {
        return $this->hasMany('App\PartialPickingLine');
    }
}
