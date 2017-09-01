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

	public function createTransaction(Request $request)//Pass in quantity as seller_amount if selling to gov.
	{
		$user = $request->user();
		$type = $request->transaction_type; // 'sell' or 'buy'
		$buyer_amount = $request->buyer_amount;
		$seller_amount = $request->seller_amount;
		$buyerItem = $buyer->resources()->id(1);//money
		// seller_amount: sell how many; buyer_amount: price
		if ($type == 'sell') {
			$seller = $user;
			if (empty($sellerItem = $user->resources()->id($request->resource_id))) {
				return view('errors.custom')->with('message', '我方：交易物品不存在');
			}
			if ($sellerItem->amount < $request->seller_amount) {
				return view('errors.custom')->with('message', '数量不够交易');
			}
			if (empty($buyer = User::id($request->buyer_id))) {
				return view('errors.custom')->with('message', '交易对方ID不存在');
			}
			if ($buyer->type == 0)//transaction with gov.
			{
				$resource_price = Resources::id($sellerItem->resource_id)->acquisition_price;
				if ($resource_price == 0) {
					return view('errors.custom')->with('message', '政府不收购此物品');
				}
				$buyer_amount *= $resource_price;
			}
//            if (empty($buyerItem = Resources::where('id', $request->buyer_item_id)->first())) {
//                return '对方：交易物品不存在';
//            }
			// Everyone has money
		} else if ($type == 'buy') {
			$buyer = $user;
			$buyerItem = $user->resources()->where('id', $request->resource_id)->first();
//			if (empty($buyerItem)) {
//                return view('errors.custom')->with('message', '我方：交易物品不存在');
//			}
			// Everyone has money
			if ($buyerItem->amount < $request->buyer_amount) {
				return view('errors.custom')->with('message', '数量不够交易');
			}
			if (empty($seller = User::id($request->seller_id))) {
				return view('errors.custom')->with('message', '交易对方ID不存在');
			}
			if (empty($sellerItem = $sellerItem = $seller->resources()->id(resource_id))) {
				return view('errors.custom')->with('message', '对方：交易物品不存在');
			}
		}
		if (!(($buyer->type - $seller->type == 1 && Resource::id($sellerItem->resource_id)->type - $seller->type == 1) || ($buyer->type == 0 && $seller->type == 2 && Resource::id($sellerItem->resource_id)->type) == 3)) {
			return view('errors.custom')->with('message', '你们之间不能交易这两种物品');
		}
		event(new NewTransaction($seller, $buyer, $sellerItem, $buyerItem, $seller_amount, $buyer_amount, $type));
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
		return view('transactions.list')
			->with('incomeTransactions',
				empty($income = $request->user()->incomeTransaction()->get()) ? [] : $income)
			->with('outcomeTransactions',
				empty($outcome = $request->user()->outcomeTransaction()->get()) ? [] : $outcome);
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
		event(new incomeTransaction($trans));

		return '成功';
	}
}
