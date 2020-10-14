<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Livewire\WithPagination;
class ProductUnity extends Model
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
    public function products(){
        return $this->hasMany('app\Product','unity_id');
    }
}
