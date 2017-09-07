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


	public function sellToUser(Request $request)//Pass in quantity as seller_amount if selling to gov.
	{
		$user = $request->user();
		$type = 'sell';
		$buyer_amount = $request->buyer_amount;
		$seller_amount = $request->seller_amount;
		// seller_amount: sell how many; buyer_amount: price
		$seller = $user;
		if (empty($sellerItem = $user->resources()->resid($request->resource_id)->first())) {
			return view('errors.custom')->with('message', '我方：交易物品不存在');
		}
		if ($sellerItem->amount < $seller_amount) {
			return view('errors.custom')->with('message', '数量不够交易');
		}
		if (empty($buyer = User::id($request->buyer_id)->first())) {
			return view('errors.custom')->with('message', '交易对方ID不存在');
		}
//            if (empty($buyerItem = Resources::where('id', $request->buyer_item_id)->first())) {
//                return '对方：交易物品不存在';
//            }
		// Everyone has money
		$buyerItem = $buyer->resources()->resid(1)->first();
		if (!$this->canTransactionMade($buyer, $seller, $buyerItem->resource()->first(), $sellerItem->resource()->first())) {
			return view('errors.custom')->with('message', '你们之间不能交易这两种物品');
		}
		event(new NewTransaction($request->user(), $seller, $buyer, $sellerItem, $buyerItem, $seller_amount, $buyer_amount, $type));

		return view('success')->with('message', '成功');
	}

	public function buyFromUser(Request $request)
	{
		$user = $request->user();
		$type = 'buy';
		$buyer_amount = $request->buyer_amount;
		$seller_amount = $request->seller_amount;
		$buyer = $user;
		$buyerItem = $buyer->resources()->resid(1)->first();
//			if (empty($buyerItem)) {
//                return view('errors.custom')->with('message', '我方：交易物品不存在');
//			}
		// Everyone has money
		if ($buyerItem->amount < $buyer_amount) {
			return view('errors.custom')->with('message', '数量不够交易');
		}
		if (empty($seller = User::id($request->seller_id)->first())) {
			return view('errors.custom')->with('message', '交易对方ID不存在');
		}
		if (empty($sellerItem = $seller->resources()->resid($request->resource_id)->first())) {
			return view('errors.custom')->with('message', '对方：交易物品不存在');
		}
		if (!$this->canTransactionMade($buyer, $seller, $buyerItem->resource()->first(), $sellerItem->resource()->first())) {
			return view('errors.custom')->with('message', '你们之间不能交易这两种物品');
		}
		event(new NewTransaction($request->user(), $seller, $buyer, $sellerItem, $buyerItem, $seller_amount, $buyer_amount, $type));

		return view('success')->with('message', '成功');
	}

	public function sellToGovernment(Request $request)
	{
		$user = $request->user();
		if ($user->type != 2) {
			return view('errors.custom')->with('message', '您不能向政府购买商品');
		}
		$seller_amount = $request->seller_amount;
		$seller = $user;
		$buyer = User::type(0)->first();
		$buyerItem = $buyer->resources()->resid(1)->first();//money
		if (empty($sellerItem = $user->resources()->resid($request->resource_id)->first())) {
			return view('errors.custom')->with('message', '我方：交易物品不存在');
		}
		if ($sellerItem->amount < $request->seller_amount) {
			return view('errors.custom')->with('message', '数量不够交易');
		}
		$acquisition_price = $sellerItem->resource->acquisition_price;
		if ($acquisition_price == 0) {
			return view('errors.custom')->with('message', '政府不收购此物品');
		}
		$buyer_amount = $seller_amount * $acquisition_price;

		event(new NewTransaction($request->user(), $seller, $buyer, $sellerItem, $buyerItem, $seller_amount, $buyer_amount, 'sell'));

		return view('success')->with('message', '成功');
	}

	public function buyFromGovernment(Request $request)
	{
		$user = $request->user();
		if ($user->type != 1) {
			return view('errors.custom')->with('message', '您不能向政府购买商品');
		}
		$seller_amount = 1;
		$seller = User::type(0)->first();
		$buyer = $user;
		$buyerItem = $buyer->resources()->resid(1)->first();
		if (empty($sellerItem = $seller->resources()->resid($request->resource_id)->first())) {
			return view('errors.custom')->with('message', '对方：交易物品不存在');
		}
		if ($sellerItem->resource->employment_price == 0) {
			return view('errors.custom')->with('message', '不能向政府购买该物品');
		}
		if ($buyerItem->amount < $sellerItem->resource->employment_price) {
			return view('errors.custom')->with('message', '您的余额不足');
		}

		$buyer_amount = $sellerItem->resource->employment_price;
		event(new NewTransaction($request->user(), $seller, $buyer, $sellerItem, $buyerItem, $seller_amount, $buyer_amount, 'buy'));

		return view('success')->with('message', '成功');

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

	public function showBuyGovCreateForm()
	{
		return view('transactions.buyFromGov');
	}

	public function showSellGovCreateForm()
	{
		return view('transactions.sellToGov');
	}

	public function showTransactionList(Request $request)
	{
		$user = $request->user();

		return view('transactions.list')->with('incomeTransactions', $user->incomeTransaction()->get())->with('outComeTransactions', $user->outcomeTransaction()->get());
	}

	public function showTransLanding(Request $request)
	{
		return view('transactions.landing');
	}

	public function handleTransaction(Request $request)
	{
		$user = $request->user();
		if (empty($trans = Transaction::query()->find($request->transactionId))) {
			return view('errors.custom')->with('message', '订单不存在');
		}
		if (($trans->type == 'buy' && $trans->seller_id != $user->id) || ($trans->type == 'sell' && $trans->buyer_id != $user->id)) {
			return view('errors.custom')->with('message', '无权访问订单');
		}

		$trans->type == 'sell' ? $checked = -1 : $checked = -2; // -1 买家 -2 卖家

		// Declined
		if ($request->confirm === 'false') {
			$trans->checked = $checked;
			$trans->save();

			return view('success')->with('message', '取消成功');
		}

		// 接受交易
		if ($trans->type == 'sell') {
			if ($user->resources()->find($trans->buyer_resource_id)->amount < $trans->buyer_amount) {
				return view('errors.custom')->with('message', '无法确认订单，物品数量不足');
			}
			if (User::id($trans->seller_id)->first()->resources()->find($trans->seller_resource_id)->amount < $trans->seller_amount) {
				return view('errors.custom')->with('message', "卖方物品数量不足，交易失败");
			}
		}
		if ($trans->type == 'buy') {
			if ($user->resources()->find($trans->seller_resource_id)->amount < $trans->seller_amount) {
				return view('errors.custom')->with('message', '无法确认订单，物品数量不足');
			}
			if (User::id($trans->buyer_id)->first()->resources()->find($trans->buyer_resource_id)->amount < $trans->buyer_amount) {
				return view('errors.custom')->with('message', "买方金钱数量不足，交易失败");
			}
		}
		$trans->checked = 1;
		$trans->save();

		event(new incomeTransaction($trans));

		return view('success')->with('message', '成功');
	}

	protected function canTransactionMade(User $buyer, User $seller, Resources $buyerItem, Resources $sellerItem)
	{
		if ($this->canUserAcquireThisProduct($buyer, $sellerItem) &&
			$this->canUserAcquireThisProduct($seller, $buyerItem) &&
			$this->canUserTransactionWithThisUser($buyer, $seller)
		) {
			return true;
		}

		return false;
	}

	protected function canUserAcquireThisProduct(User $user, Resources $product)
	{
		if (in_array($product->type, $user->transactionRule()->first()->resource_type)) {
			return true;
		};

		return false;
	}

	protected function canUserTransactionWithThisUser(User $user, User $opposite)
	{
		if (in_array($opposite->type, $user->transactionRule()->first()->user_transaction_type)) {
			return true;
		};

		return false;
	}
}
