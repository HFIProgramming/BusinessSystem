<?php

namespace App\Http\Controllers;

use App\Config;
use App\Events\NewTransaction;
use App\Events\StockTransaction;
use App\Stock;
use Illuminate\Http\Request;
use App\User;

class StockController extends Controller
{
    //

    public function buyStock(Request $request)
    {
        $limit = Config::KeyValue('stock_transactions_limit')->value;
        if($request->user()->stockTransactionTimes() >= $limit)
        {
            return view('errors.custom')->with('message', '本财年股票交易次数已上限');
        }
        $buyer = $request->user();
        $seller = User::type(0)->first();
        $amount = $request->amount;
        $buyerItem = $buyer->resources()->resid(1)->first();//money
        if(empty($stock = Stock::find($request->stock_id)))
        {
            return view('errors.custom')->with('message', '该股票不存在');
        }
        $sellerItem = $seller->resources()->resid($stock->resource->id)->first();
        $sellerAmount = $amount;
        $buyerAmount = $amount * $stock->sellPrice();
        if($buyer->type != 2)
        {
            return view('errors.custom')->with('message', '您不能进行股票交易');
        }
        if($buyerItem->amount < $buyerAmount)
        {
            return view('errors.custom')->with('message', '您的余额不足');
        }
        if($sellerAmount > $stock->sell_remain)
        {
            $sellerAmount = $stock->sell_remain;
        }

        event(new NewTransaction($request->user(), $seller, $buyer, $sellerItem, $buyerItem, $sellerAmount, $buyerAmount, 'stock_buy'));
        event(new StockTransaction($buyer, $stock, 'buy', $sellerAmount));
        //Price Updates are written in StockTransaction Event
        return view('success')->with('message', '购买成功');

    }

    public function sellStock(Request $request)
    {
        $limit = Config::KeyValue('stock_transactions_limit')->value;
        if($request->user()->stockTransactionTimes() >= $limit)
        {
            return view('errors.custom')->with('message', '本财年股票交易次数已上限');
        }
        $buyer = User::type(0)->first();
        $seller = $request->user();
        $amount = $request->amount;
        $buyerItem = $buyer->resources()->resid(1)->first();//money
        if(empty($stock = Stock::find($request->stock_id)))
        {
            return view('errors.custom')->with('message', '该股票不存在');
        }
        $sellerItem = $seller->resources()->resid($stock->resource->id)->first();
        $sellerAmount = $amount;
        $buyerAmount = $amount * $stock->buyPrice();
        if($seller->type != 2)
        {
            return view('errors.custom')->with('message', '您不能进行股票交易');
        }
        if($sellerItem->amount < $sellerAmount)
        {
            return view('errors.custom')->with('message', '您持有的该股票不足进行交易');
        }
        if($sellerAmount > $stock->buy_remain)
        {
            $sellerAmount = $stock->buy_remain;
//            return 'dont move, you '.$buyerAmount;
        }

        event(new NewTransaction($request->user(), $seller, $buyer, $sellerItem, $buyerItem, $sellerAmount, $buyerAmount, 'stock_sell'));
        event(new StockTransaction($seller, $stock, 'sell', $buyerAmount));
        //Prices Updates are written in StockTransaction Event
        return view('success')->with('message', '出售成功');
    }

    public function sendData(Request $request)
    {
        $response = [];
        $user = $request->user();
        foreach (Stock::all() as $stock)
        {
            $all_prices = $stock->history_prices;
            array_push($all_prices, $stock->current_price);
            $stockData = [];
            $stockData['id'] = $stock->id;
            $stockData['current_price'] = $stock->current_price;
            $stockData['all_prices'] = $all_prices;
            $stockData['company_name'] = $stock->company->name;
            $stockData['total'] = $stock->total;
            $stockData['dividend'] = $stock->dividend;
            $stockData['sell_remain'] = $stock->sell_remain;
            $stockData['buy_remain'] = $stock->buy_remain;
            $stockData['current_buy'] = $stock->buyPrice();
            $stockData['current_sell'] = $stock->sellPrice();
            $stockData['hand_up'] = $user->resources()->resid($stock->resource_id)->first()->amount;
            array_push($response, $stockData);
        }
        return $response;
    }

    public function viewStocks(Request $request)
    {
        $user = $request->user();
        return view('stocks.list')->with('stocks', Stock::all());
    }
}
