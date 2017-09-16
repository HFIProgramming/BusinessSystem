<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resources extends Model
{
	//
	protected $casts = [
		'requirement'   => 'array',
		'equivalent_to' => 'array',
	];

	protected $fillable = [
		'code', 'name', 'description', 'type',
		'requirement', 'equivalent_to',
		'acquisition_price', 'employment_price',
		'required_tech', 'tech_type', 'tech_level', 'tech_price',
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
				break;
			case 4:
				return '采矿队';
				break;
			case 5:
				return '科技等级';
				break;
			default:
				return '这尼玛是什么玩意';
		}
	}

	public function scopeId($query, $id)
	{
		return $query->where('id', $id);
	}
}
