<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    public $fillable = ['name', 'surname', 'live', 'experience', 'registered', 'reservoir_id'];

    public function reservoir(){
        return $this->belongsTo('App\Reservoir');
    }
}
