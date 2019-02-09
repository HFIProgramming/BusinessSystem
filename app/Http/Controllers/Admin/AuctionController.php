<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Config;
use App\Auction;

class AuctionController extends Controller
{
    //
    public function showAuctionControlPanel()
    {
    	// Use this page to configure auctions: start, end, set amount, show current bids, etc.
    }

    public function setStatusAndAmount(Request $request)
    {
    	if ($request->status != NULL) {
			$status = Config::KeyValue('auction_activated');
			$status->value = $request->status;
			$status->save();
		} elseif ($request->amount != NULL) {
			$amount = Config::KeyValue('auction_amount');
			$amount->value = $request->amount;
			$amount->save();
		}

		return redirect()->back();
    }

    public function doTransactions()
    {
    	if(Config::KeyValue('auction_activated') == 1)
    	{
    		return view('errors.custom')->with('message', '先停止竞拍');
    	}
    	$year = Config::KeyValue('current_round')->value;
    	$auctionAmount = Config::KeyValue('auction_amount')->value;
    	$bidsToAccept = Auction::where('year', $year)->where('status', 'submitted')->orderBy('price', 'desc')->oldest()->take($auctionAmount)->get();//test if this ordering works!!
    	foreach($bidsToAccept as $bid)
    	{
    		$bid->status = 'successful';
    		$bid->save();
    		$resource_id = Config::KeyValue('auction_item_id')->value;
    		$seller = User::type(0)->first();
            $sellerItem = $seller->resources()->resid($resource_id)->first();
            $sellerAmount = 1;
            $buyer = $bid->user;
            $buyerItem = $buyer->resources()->resid(1)->first();
            $buyerAmount = $bid->price;
            event(new NewTransaction($seller, $seller, $buyer, $sellerItem, $buyerItem, $sellerAmount, $buyerAmount, 'auction'));
    	}
    	Auction::where('year', $year)->where('status', 'submitted')->update(['status' => 'unsuccessful']);//reject the rest: sorry, bye!

    	return redirect()->back();
    }
}
