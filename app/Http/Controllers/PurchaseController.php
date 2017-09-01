<?php

namespace App\Http\Controllers;

use App\Events\BuyStuff;
use App\Resources;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
	//
	public function __construct()
	{
	}

	public function TopUp(Request $request)
	{
		$item = Resources::query()->where('id',$request->id)->first();
		$user = $request->user();

		foreach ($item->requirement as $key => $value){
			if ($user->resources()->where('name',$key)->amount < $amount = $value * $request->amount){
				return "材料 {$key} 不足，需要 {$amount} ";
		    }
		}

		event(new BuyStuff($user,$item,$request->amount));

		return '成功';
	}
}
