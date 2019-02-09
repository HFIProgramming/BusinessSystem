<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acquisition extends Model
{
    //
    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function resource()
    {
    	return $this->belongsTo('App\Resources');
    }
}
