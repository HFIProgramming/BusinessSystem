<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    //
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
