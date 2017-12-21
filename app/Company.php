<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $table = 'companies';
    protected $fillable = ['name', 'last_year_profit'];

    public function stock()
    {
        return $this->hasOne('App\Stock');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function pollutionIndex()
    {
        return $this->user->resources()->resid(7)->first()->amount;
    }
}
