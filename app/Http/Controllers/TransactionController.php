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
		// seller_amount: sell how many; buyer_amount: price
		if ($type == 'sell') {
			$seller = $user;
			$sellerItem = $user->resources()->where('id', $request->seller_item)->first();
			if (empty($sellerItem)) {
				return view('errors.custom')->with('message', '你方：交易物品不存在');
			}
			if ($sellerItem->amount < $request->seller_amount) {
                return view('errors.custom')->with('message', '数量不够交易');
			}
			if (empty($buyer = User::query()->where('id', $request->buyer_id)->first())) {
                return view('errors.custom')->with('message', '交易对方ID不存在');
			}
//            if (empty($buyerItem = Resources::where('id', $request->buyer_item_id)->first())) {
//                return '对方：交易物品不存在';
//            }

		} else if ($type == 'buy') {
			$seller = User::query()->where('id', $request->seller_id)->first();
			$buyer = $user;
			$buyerItem = $user->resources()->where('id', $request->buyer_item)->first();
			$sellerItem = Resources::query()->where('id', $request->seller_id)->first();
			if (empty($buyerItem)) {
                return view('errors.custom')->with('message', '你方：交易物品不存在');
			}
			if ($buyerItem->amount < $request->buyer_amount) {
                return view('errors.custom')->with('message', '数量不够交易');
			}
			if (empty($seller)) {
                return view('errors.custom')->with('message', '交易对方ID不存在');
			}

		}
		event(new NewTransaction($seller, $buyer, $sellerItem, $buyerItem, $request->seller_amount, $request->buyer_amount, $type));

		return '成功';
	}

	/**
	 * 用户是买方
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function showIncomeCreateForm()
	{
		return view('transactions.newInTrans');
	}

	/**
	 * 用户是卖方
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function showOutcomeCreateForm()
	{
		return view('transactions.newOutTrans');
	}

	public function showTransactionList(Request $request)
	{
		return view('transactions.list')->with('incomeTransactions', $request->user()->incomeTransaction()->get())->with('outComeTransactions', $request->user->outcomeTransaction()->get());
	}

	public function handleTransaction(Request $request)
	{
		$user = $request->user();
		if (empty($trans = Transaction::query()->where('id', $request->transactionId)->first())) {
			return view('errors.custom')->with('message', '订单不存在');
		}
		if (($trans->type == 'buy' && $trans->seller_id != $user->id) || ($trans->type == 'sell' && $trans->buyer_id != $user->id)) {
			return view('errors.custom')->with('message', '无权访问订单');
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
				return view('errors.custom')->with('message', '无法确认订单，物品数量不足');
			}
			if (User::id($trans->seller_id)->resources()->id($trans->seller_resource_id)->amount < $trans->seller_amount) {
				return view('errors.custom')->with('message', "卖方物品数量不足，交易失败");
			}
		}
		if ($trans->type == 'buy') {
			if ($user->resources()->id($trans->seller_resource_id)->amount < $trans->seller_amount) {
				return view('errors.custom')->with('message', '无法确认订单，物品数量不足');
			}
			if (User::id($trans->buyer_id)->resources()->id($trans->buyer_resource_id)->amount < $trans->buyer_amount) {
				return view('errors.custom')->with('message', "买方金钱数量不足，交易失败");
			}
		}
		event(new incomeTransaction($user, $trans));

		return '成功';
	}
}
