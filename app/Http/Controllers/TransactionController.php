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
		$sellerItem = $user->resources()->where('id', $request->buyer_resource_id)->first();
		if (empty($sellerItem)) {
			return '你方：交易物品不存在';
		}
		if ($sellerItem->amount < $request->buyer_amount) {
			return '数量不够交易';
		}
		if (empty($buyer = User::query()->where('id', $request->seller_id)->first())) {
			return '交易对方ID不存在';
		}
		if (empty($buyerItem = Resources::query()->where('id', $request->buyer_id)->first())) {
			return '对方：交易物品不存在';
		}
		event(new NewTransaction($user, $buyer, $sellerItem, $buyerItem, $request->seller_amount, $request->buyer_amount));

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
		if (empty($trans = Transaction::query()->where('id', $request->transactionId)->first())) {
			return '订单不存在';
		}
		if (!($trans->buyer_id == $user->id || $trans->seller_id == $user->id || $user->id == 1)) {
			return '无权访问订单';
		}

		$trans->buyer_id == $user->id ? $checked = -1 : $checked = -2; // -1 买家 -2 卖家

		// Declined
		if ($request->comfirm == false) {
			$trans->checked = $checked;
			$trans->save();

			return '取消成功';
		}

		// 买家确认
		if ($checked == -1) {
			if ($user->resources()->where('resource_id', $trans->buyer_resource_id)->first()->amount < $trans->buyer_amount) {
				return '无法确认订单，物品数量不足';
			}
			event(new incomeTransaction($user, $trans));

			return '成功';
		}
	}
}
