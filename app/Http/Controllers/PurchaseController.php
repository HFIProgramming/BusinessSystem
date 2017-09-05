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
		$item = Resources::query()->where('id', $request->item_id)->first();
		$user = $request->user();
		$message = "";

		if (empty($item)) {
			return view('errors.custom')->with('message', '商品不存在');
		}

		if (!empty($item->requirement)) {
			foreach ($item->requirement as $key => $value) {
				if ($user->resources()->where('name', $key)->amount < $amount = $value * $request->amount) {
					$message .= "材料 {$key} 不足，需要 {$amount} \n";
				}
			}
		}

		if ($message != "") return view('errors.custom')->with('message', $message);

		event(new BuyStuff($user, $item, $request->amount));

		return view('success')->with('message', $message);
	}

	public function showPurchaseForm()
	{
		return view('resources.purchase');
	}
}
