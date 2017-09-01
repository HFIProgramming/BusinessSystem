<?php

namespace App\Http\Controllers;

use App\Events\incomeTransaction;
use App\Events\NewTransaction;
use App\Resources;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
	//
	public function __construct()
	{

	}

	public function createTransaction(Request $request)
	{
		$user = $request->user();
		$type = $request->transaction_type; // 'sell' or 'buy'
        $buyerItem = $buyer->resources()->id(1);//money
        // seller_amount: sell how many; buyer_amount: price
        if($type == 'sell') {
            $seller = $user;
            if (empty($sellerItem = $user->resources()->id($request->resource_id))) {
                return '你方：交易物品不存在';
            }
            if ($sellerItem->amount < $request->seller_amount) {
                return '数量不够交易';
            }
            if (empty($buyer = User::id($request->buyer_id))) {
                return '交易对方ID不存在';
            }
//            if (empty($buyerItem = Resources::where('id', $request->buyer_item_id)->first())) {
//                return '对方：交易物品不存在';
//            }
        }
        else if($type == 'buy')
        {
            $buyer = $user;
            $buyerItem = $buyer->resources()->id(1);//money
//            if(empty($buyerItem))
//            {
//                return '你方：交易物品不存在';
//            }
            if($buyerItem->amount < $request->buyer_amount)
            {
                return '数量不够交易';
            }
            if(empty($seller = User::id($request->seller_id)))
            {
                return '交易对方ID不存在';
            }
            $sellerItem = $seller->resources()->id(resource_id);

        }
		event(new NewTransaction($seller, $buyer, $sellerItem, $buyerItem, $request->seller_amount, $request->buyer_amount, $type));
		return '成功';
	}

	public function showTransaction(Request $request)
	{
		return view('incomeTransaction');
	}

	public function handleTransaction(Request $request)
	{
		$user = $request->user();
		// 买家还是卖家？
		if (empty($trans = Transaction::where('id', $request->transactionId)->first())) {
			return '订单不存在';
		}
		if (($trans->type=='buy' && $trans->seller_id != $user->id) || ($trans->type=='sell' && $trans->buyer_id != $user_id)) {
			return '无权访问订单';
		}

		$trans->type == 'sell' ? $checked = -1 : $checked = -2; // -1 买家 -2 卖家

		// Declined
		if ($request->comfirm == false) {
			$trans->checked = $checked;
			$trans->save();
			return '取消成功';
		}

		// 接受交易
		if ($trans->type == 'sell') {
			if ($user->resources()->id($trans->buyer_resource_id)->amount < $trans->buyer_amount) {
				return '无法确认订单，物品数量不足';
			}
			if (User::id($trans->seller_id)->resources()->id($trans->seller_resource_id)->amount < $trans->seller_amount) {
                return "卖方物品数量不足，交易失败";
            }
		}
		if ($trans->type == 'buy'){
		    if ($user->resources()->id($trans->seller_resource_id)->amount < $trans->seller_amount) {
		        return '无法确认订单，物品数量不足';
            }
            if (User::id($trans->buyer_id)->resources()->id($trans->buyer_resource_id)->amount < $trans->buyer_amount) {
                return "买方金钱数量不足，交易失败";
            }
        }
        event(new incomeTransaction($user, $trans));
        return '成功';
	}
}
