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

		if (!$this->canUserAcquireThisProduct($user, $item)) {
			return view('errors.custom')->with('message', '你不能购买这个商品');
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

		return view('success')->with('message', '升级成功');
	}

	public function showPurchaseForm()
	{
		return view('resources.purchase');
	}

	protected function canUserAcquireThisProduct(User $user, Resources $product)
	{
		if (in_array($product->type, $user->transactionRule()->first()->resource_type)) {
			return true;
		};

		return false;
	}
}
