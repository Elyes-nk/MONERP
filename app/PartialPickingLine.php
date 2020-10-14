<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartialPickingLine extends Model
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
    public function picking()
    {
        return $this->belongsTo('App\PartialPicking');
    }
    public function move()
    {
        return $this->belongsTo('App\ReceptionLine','id');
    }
}
