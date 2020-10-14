<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Sequence extends Model

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

    public static function searchByName($name):array
    {
        $sequences=self::all();
        if($name==""){
            return $sequences->all();
        }
        return collect($sequences)
        ->filter( function($sequences) use($name){
                return Str::contains(strtolower($sequences['name']),strtolower($name));
        } )->all();
    }
}
