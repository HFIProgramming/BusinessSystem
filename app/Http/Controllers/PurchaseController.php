<?php

namespace App\Http\Controllers;

use App\Events\BuyStuff;
use App\Resources;
use App\User;
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

		if (!(($this->canUserAcquireThisProduct($user, $item)) && ($item->type != 0))) { // 中间货币不能被直接购买
			return view('errors.custom')->with('message', '你不能购买这个商品');
		}

		$requirement = ($item->requirement)[$user->techLevel($item->required_tech)];

		if (!empty($requirement)) {
			foreach ($requirement as $key => $value) {
				if ($user->resources()->resid($key)->first()->amount < ($amount = $value * $request->amount)) {
					$message .= ($user->resources()->resid($key)->first()->resource->name)." 不足，需要 {$amount} \n";
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
