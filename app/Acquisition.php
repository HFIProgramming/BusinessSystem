<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acquisition extends Model
{
    //
	protected $fillable = ['user_id', 'year', 'resource_id', 'price', 'amount', 'status'];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function resource()
    {
    	return $this->belongsTo('App\Resources');
    }
}
