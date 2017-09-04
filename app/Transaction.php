<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\Resource;

class Transaction extends Model
{
	//
	public function seller()
	{
		return $this->belongsTo(User::class, 'seller_id');
	}

	public function buyer()
	{
		return $this->belongsTo(User::class, 'buyer_id');
	}

	public function buyerResource()
	{
		return $this->belongsTo(UserResource::class, 'buyer_resource_id');
	}

	public function sellerResource()
	{
		return $this->belongsTo(UserResource::class,'seller_resource_id');
	}
}
