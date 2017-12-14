<?php

namespace App\Http\Controllers;

use App\Events\BuyStuff;
use App\Events\NewTransaction;
use App\Resources;
use App\User;
use App\Zone;
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

	public function buildArchitecture(Request $request)//This function is specifically for purchases that come along with transactions
    {
        if(empty($zone = Zone::find($request->zone_id)))
        {
            return view('errors.custom')->with('message', '你来到了建筑的荒原');//使用知乎体是怎样一种体验？
        }
        $view = $this->TopUp($request);
        if($view != view('success')->with('message', '升级成功'))
        {
            return $view;
        }
        $resource = Resources::find($request->item_id);
        $user = $request->user();
        foreach ($resource->tax as $item => $amount)
        {
            $seller = $user;
            $buyer = $zone->user;
            $buyerItem = $seller->resources()->resid(1)->first(); //This can be anything, in fact, for the amount is 0.
            $buyerAmount = 0;
            $sellerItem = $seller->resources()->resid($item)->first();
            $sellerAmount = $amount;
            event(new NewTransaction($user, $seller, $buyer, $sellerItem, $buyerItem, $sellerAmount, $buyerAmount, 'special'));
        }
        return view('success')->with('message', '建造完成');
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
