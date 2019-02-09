<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auction;
use App\Config;
use App\IntToVal;

class AuctionController extends Controller
{
    //
    public function showBidForm(Request $request)
    {
    	if(Config::KeyValue('auction_activated') == 1)
    	{

    	}
    	else
    	{
    		return view('errors.custom')->with('message', '目前不能竞拍呢！');
    	}
    }

    public function listBids(Request $request)
    {

    }

    public function submitBid(Request $request)
    {
    	$user = $request->user();
    	$price = $request->price;
    	if(empty(IntToVal('acceptable_bid_range', $price)))
    	{
    		//unacceptable price
    		return view('errors.custom')->with('message', '竞拍价格不在可接受范围内');
    	}
    	if($user->resources()->resid(1)->first()->amount < $price)
    	{
    		//not enough money
    		return view('errors.custom')->with('message', '竞价可别放卫星呀！您没有这么多钱！');
    	}
    	if(Config::KeyValue('auction_activated') == 0)
    	{
    		return view('errors.custom')->with('message', '目前不能竞拍呢！');
    	}
    	$user->auctions()->create([
    		'price' => $price,
    		'year' => Config::KeyValue('current_round')->value,
    		'status' => 'submitted'
    	]);
    }
}
