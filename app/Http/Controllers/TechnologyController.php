<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Technology;
use App\Resources;
use App\User;
use App\Events\NewTransaction;

class TechnologyController extends Controller
{
    //
    public function __construct()
    {
    }

    public function showTechPage(Request $request)
    {
        $user = $request->user();
        $tech_type = 1;
        $level = $user->techLevel($tech_type);
        return view('technologies.show')->with('level', $level);
    }

    public function updateTech(Request $request)
    {
        $user = $request->user();
//        $tech_type = $request->tech_type; //There is only one meaningful type now anyway
        $tech_type = 1;//for less front-end work
        $currentLevel  = $user->techLevel($tech_type);
        $newTech = Resources::where('tech_type', $tech_type)->where('tech_level', $currentLevel+1)->first();
        if ($user->type != 2 || $tech_type != 1) {
            return view('errors.custom')->with('message', '您不能进行该升级');
        }
        if(empty($newTech)) {
            return view('errors.custom')->with('message', '这项科技已经达到顶级');
        }
        $seller_amount = 1;
        $seller = User::type(0)->first();
        $buyer = $user;
        $buyerItem = $buyer->resources()->resid(1)->first();
        $sellerItem  = $seller->resources()->resid($newTech->id)->first();
        if ($buyerItem->amount < $sellerItem->resource->tech_price) {
            return view('errors.custom')->with('message', '您的余额不足');
        }

        $buyer_amount = $sellerItem->resource->tech_price;
        event(new NewTransaction($request->user(), $seller, $buyer, $sellerItem, $buyerItem, $seller_amount, $buyer_amount, 'buy_tech'));
        $tech = Technology::where('user_id', $user->id)->where('type', $tech_type)->first();
        $tech->level += 1;
        $tech->save();

        return view('success')->with('message', '成功');
    }
}
