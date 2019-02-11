<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resources extends Model
{
	//
	protected $casts = [
		'requirement'   => 'array',
		'equivalent_to' => 'array',
		'tax' => 'array'
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
				return '建筑';
				break;
			case 3:
				return '成品机器人';
				break;
			case 4:
				return '建筑建造';
				break;
			case 5:
				return '科技等级';
				break;
			case 6:
				return '指数';
				break;
			case 7:
				return '耗材';
				break;
			default:
				return '这尼玛是什么玩意';
		}
	}

	public function scopeId($query, $id)
	{
		return $query->where('id', $id);
	}

	public function stock()
	{
		return $this->hasOne(Stock::class, 'resource_id');
	}
}
