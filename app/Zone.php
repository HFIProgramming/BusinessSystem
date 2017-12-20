<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    //
    protected $fillable = ['user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function powerIndex()
    {
        return $this->user->resources()->resid(5)->amount;
    }

    public function happinessIndex()
    {
        return $this->user->resources()->resid(6)->amount;
    }
}
