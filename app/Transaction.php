<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
	//
	public function seller()
	{
		return $this->belongsTo(User::class, 'seller_id');
	}

	public function buyer()
	{
		return $this->belongsTo(User::class,'buyer_id');
	}
}
