<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    //
    protected $fillable = ['user_id', 'name'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function powerIndex()
    {
        return $this->user->resources()->resid(5)->first()->amount;
    }

    public function happinessIndex()
    {
        return $this->user->resources()->resid(6)->first()->amount;
    }

    public function regionalMiningIndex()
    {
        return $this->user->resources()->resid(7)->first()->amount;
    }
}
