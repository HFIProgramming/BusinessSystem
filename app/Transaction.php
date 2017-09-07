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

	public function starter()
    {
        return $this->belongsTo(User::class, 'starter_id');
    }

	public function buyerResource()
	{
		return $this->belongsTo(UserResource::class, 'buyer_resource_id');
	}

	public function sellerResource()
	{
		return $this->belongsTo(UserResource::class, 'seller_resource_id');
	}

	public function getStatusAttribute()
	{
		switch ($this->checked){
			case 0:
				return '待确认';
				break;
			case 1:
				return '已完成';
				break;
			case -1:
				return '由买家取消';
				break;
			case -2:
				return '由卖家取消';
				break;
			default:
				return '这他妈什么情况？？？';
				break;
		}
	}
}
