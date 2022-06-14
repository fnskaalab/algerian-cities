<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name', 'arabic_name', 'post_code', 'state_id', 'longitude', 'latitude'];

    /*
|------------------------------------------------------------------------------------
| Relations
|------------------------------------------------------------------------------------
    */

    public function state()
    {
        return $this->belongsTo(State::class,'state_id');
    }


}
