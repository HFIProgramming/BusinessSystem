<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    //
    protected $fillable = ['user_id', 'year', 'price', 'status'];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
