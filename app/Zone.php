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

    public function powerIndex()
    {
        return $this->user->resources()->resid()->amount;//@TODO Fill resid()!!
    }

    public function happinessIndex()
    {
        return $this->user->resources()->resid()->amount;//@TODO Fill resid()!!
    }
}
