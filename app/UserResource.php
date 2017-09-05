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
	public function scopeResid($query, $id)
	{
		return $query->where('resource_id', $id);
	}

	public function resource()
	{
		return $this->belongsTo(Resources::class,'resource_id');
	}

	public function user()
    {
        return $this->belongsTo(User::class);
    }
}
