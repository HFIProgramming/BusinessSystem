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

	public function TopUp(Request $request) // This is for building robots and chips and for building architectures
	{
		$item = Resources::query()->where('id', $request->item_id)->first();
		$user = $request->user();
		$message = "";

		if (empty($item)) {
			return view('errors.custom')->with('message', '人类似乎还不能制造你所说的物品');
		}

		if (!$this->canUserAcquireThisProduct($user, $item) || $item->type == 0 || $item->type == 4) { // 中间货币不能被直接购买
			return view('errors.custom')->with('message', '不允许你制造这种物品！');
		}
		
        return $this->doManufactureOrBuild($item, $request->amount, $user);
	}

	public function buildArchitecture(Request $request) //This function is specifically for purchases that come along with transactions
    {
        $resource = Resources::find($request->item_id);
        $user = $request->user();
        $zone_id = $user->type;
        if(empty($resource) || $resource->type != 4) //Refer to migrations to see type.
        {
            return view('errors.custom')->with('message', '挖土机、推土机、钢筋混凝土、包工头等均表示无法理解你要建造什么建筑');
        }
        if(empty($zone = Zone::find($zone_id))) //This should now be fixed.
        {
            return view('errors.custom')->with('message', '你似乎来到了没有建筑存在的荒原');//使用知乎体是怎样一种体验？
        }
        if (!(($this->canUserAcquireThisProduct($user, $resource)) && ($resource->type != 0))) { // 中间货币不能被直接购买
            return view('errors.custom')->with('message', '你不能建造这种建筑');
        }
        $view = $this->doManufactureOrBuild($resource, $request->amount, $user);
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

        $purchased = $resource;
        foreach($purchased->equivalent_to as $built_id => $quantity)//This merely does the statistics and does not update the quantity of resources -- it is already updated in the TopUp event.
        {
            $built = $user->resources()->resid($built_id)->first();
            $zones = $built->zones;
            if (array_key_exists($zone->id, $built->zones)) {
                $zones[$zone->id] += $quantity * $request->amount;
            } else {
                $zones[$zone->id] = $quantity * $request->amount;
            }
            $built->zones = $zones;
            $built->save();
        }

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

	public function showBuildForm()
    {
        return view('resources.build');
    }

	protected function canUserAcquireThisProduct(User $user, Resources $product)
	{
		if (in_array($product->type, $user->transactionRule()->first()->resource_type)) {
			return true;
		};

		return false;
	}

    protected function doManufactureOrBuild($item, $requested_amount, $user)
    {
        $requirement = ($item->requirement)[$user->techLevel($item->required_tech)];
        $message = "";

        if (!empty($requirement)) {
            foreach ($requirement as $key => $value) {
                if ($user->resources()->resid($key)->first()->amount < ($amount = $value * $requested_amount)) {
                    $message .= ($user->resources()->resid($key)->first()->resource->name)." 不足，需要 {$amount} \n";
                }
            }
        }

        if ($message != "") return view('errors.custom')->with('message', $message);

        event(new BuyStuff($user, $item, $requested_amount));

        return view('success')->with('message', '建造完成');
    }
}
