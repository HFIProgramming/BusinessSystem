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
			return view('errors.custom')->with('message', '建筑不存在');
		}

		if (!(($this->canUserAcquireThisProduct($user, $item)) && ($item->type != 0))) { // 中间货币不能被直接购买
			return view('errors.custom')->with('message', '你不能建造这个建筑');
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

		return view('success')->with('message', '建造完成');
	}

	public function buildArchitecture(Request $request)//This function is specifically for purchases that come along with transactions
    {
        $resource = Resources::find($request->item_id);
        $user = $request->user();
        if($resource->type != 2 || empty($resource))//Refer to migrations to see type.
        {
            return view('errors.custom')->with('message', '不能建造这种建筑');
        }
        if(empty($zone = Zone::find($request->zone_id)))
        {
            return view('errors.custom')->with('message', '你似乎来到了没有建筑存在的荒原');//使用知乎体是怎样一种体验？
        }
        $view = $this->TopUp($request);
        //Just a word of warning:
        //TopUp Event automatically resolves the equivalent_to field and gives corresponding resources
        //But this does NOT create a chain reaction as Transaction does
        //In other words, Transaction resolves the equivalent_to fields of the items gained from the equivalent_to fields, and this goes on.
        //For example, you buy something called A, and it is equivalent to B,C,D, in which B is equivalent to E,F.
        //Then, you get A through F.
        //However, TopUp does not do this.
        //Contact msasysu.lzh@icloud.com or wechat 18124289726 if you do not understand.
        //Perhaps there is a better place to place this warning.
        if($view != view('success')->with('message', '建造完成'))
        {
            return $view;
        }

        $built = $user->resources()->resid($request->item_id)->first();
        if(array_key_exists($zone->id,$built->zones))
        {
            $built->zones[$zone->id]++;
        }
        else
        {
            $built->zones[$zone->id] = 1;
        }
        $built->save();

        foreach ($resource->tax as $item => $amount)
        {
            $seller = User::type(0)->first();//This should NOT be the purchaser because 无中生有
            $buyer = $zone->user;
            $buyerItem = $seller->resources()->resid(1)->first(); //This can be anything, in fact, for the amount is 0.
            $buyerAmount = 0;
            $sellerItem = $seller->resources()->resid($item)->first();
            $sellerAmount = $amount;
            event(new NewTransaction($user, $seller, $buyer, $sellerItem, $buyerItem, $sellerAmount, $buyerAmount, 'special'));
        }
        return $view;
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
