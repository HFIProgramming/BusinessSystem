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
        $user = $request->user();
        $year = Config::KeyValue('current_round')->value;
        if(Config::KeyValue('auction_activated')->value == 1)
        {
            if(empty($user->auctions()->where('year', $year)->first()))
            {
                return view('auction.createBid')->with('year', $year)->with('auction_amount', Config::KeyValue('auction_amount')->value);
            }
            return view('errors.custom')->with('message', '本财年已经提交过竞拍啦');
        }
        else
        {
            return view('errors.custom')->with('message', '目前不能竞拍呢！');
        }
    }

    public function listBids(Request $request)
    {
        $user = $request->user();
        $bids = $user->auctions()->latest()->get();
        return view('auction.list')->with('bids', $bids);
    }

    public function submitBid(Request $request)
    {
        $user = $request->user();
        $price = $request->price;
        $year = Config::KeyValue('current_round')->value;
        if(empty(IntToVal::IntervalValue('acceptable_bid_range', $price)->value))
        {
            //unacceptable price
            return view('errors.custom')->with('message', '竞拍价格不在可接受范围内');
        }
        if($user->resources()->resid(1)->first()->amount < $price)
        {
            //not enough money
            return view('errors.custom')->with('message', '竞价可别放卫星呀！您没有这么多钱！');
        }
        if(Config::KeyValue('auction_activated')->value == 0)
        {
            return view('errors.custom')->with('message', '目前不能竞拍呢！');
        }
        if(!empty($user->auctions()->where('year', $year)->first()))
        {
            return view('errors.custom')->with('message', '本财年已经提交过竞拍啦');
        }
        $user->auctions()->create([
            'price' => $price,
            'year' => Config::KeyValue('current_round')->value,
            'status' => 'submitted'
        ]);
        return view('success')->with('message', '提交成功');
    }
}
