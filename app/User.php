<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password', 'type',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	public function resources()
	{
		return $this->hasMany(UserResource::class);
	}

	public function techLevel($tech_type)
	{
		return $this->hasMany(Technology::class)->where('type', $tech_type)->first()->level;
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function outcomeTransaction()
	{
		return $this->hasMany(Transaction::class, 'seller_id');
	}

	public function incomeTransaction()
	{
		return $this->hasMany(Transaction::class, 'buyer_id');
	}

	public function scopeId($query, $id)
	{
		return $query->where('id', $id);
	}

	public function scopeType($query, $type)
	{
		return $query->where('type', $type);
	}

	public function getAllTransAttribute()
	{
		return $this->incomeTransaction()->get()->merge($this->outcomeTransaction()->get());
	}

	public function transactionRule()
	{
		return $this->belongsTo(UserTransactionRule::class, 'type', 'user_type');
	}

	public function getUserTypeAttribute()
	{
		switch ($this->type) {
			case 0:
				return '管理员';
				break;
			case 1:
				return '原材料商';
				break;
			case 2:
				return '加工商';
				break;
			default:
				return '你什么鬼？';
				break;
		}
	}
}

