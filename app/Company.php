<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $table = 'companies';

    public function stock()
    {
        return $this->hasOne('App\Stock');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function pollutionIndex()//@TODO resid() NOT FILLED IN!
    {
        return $this->user->resources->resid()->first()->amount;
    }
}
