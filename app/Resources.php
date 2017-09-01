<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resources extends Model
{
	//
	protected $casts = [
		'requirement' => 'array',
	];

	public function getResourceTypeAttribute()
	{
		switch ($this->type) {
			case 0:
				return '中间货币';
				break;
			case 1:
				return '原材料';
				break;
			case 2:
				return '半成品';
				break;
			case 3:
				return '完成品';
			default:
				return '这尼玛是什么玩意';
		}
	}

	public function scopeId($query, $id)
	{
		return $query->where('id', $id)->first();
	}
}
