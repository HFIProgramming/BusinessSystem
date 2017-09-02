<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\Resource;

class UserResource extends Model
{
	protected $fillable = [
		'resource_id', 'user_id', 'amount',
	];

	//
	public function scopeId($query, $id)
	{
		return $query->where('id', $id)->first();
	}

	public function resource()
	{
		return $this->belongsTo(Resources::class,'resource_id');
	}
}
