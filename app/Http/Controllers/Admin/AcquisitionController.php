<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Config;
use App\Acquisition;

class AcquisitionController extends Controller
{
    //
    public function showAcquisitionControlPanel()
    {
    	$year = Config::KeyValue('current_round')->value;
    	$status = Config::KeyValue('acquisition_activated')->value;
    	$acquisition_item_and_amount = json_decode(Config::KeyValue('acquisition_items_and_amount')->value, true);
    	$bids = Acquisition::where('year', $year)->get();
    	return view('admin.acquisition_control')->with('bids', $bids)->with('year', $year)->with('status', $status)->with('acquisition_items_and_amount', $acquisition_items_and_amount);
    }

    public function setStatus(Request $request)
	{
		$status = Config::KeyValue('acquisition_activated');
		$status->value = $request->status;
		$status->save();
		return redirect()->back();
	}

	public function setAmount(Request $request)
	{
		$acquisition_items_and_amount = Config::KeyValue('acquisition_items_and_amount');
		$acquisition_items_and_amount->value = json_encode($request->input('acquisition_items_and_amount'));
		$acquisition_items_and_amount->save();
		return redirect()->back();
	}

	public function doTransactions()
	{
		if(Config::KeyValue('acquisition_activated') == 1)
		{
			return view('errors.custom')->with('message', '先停止收购');
		}
		$year = Config::KeyValue('current_round')->value;
		$acquisition_items_and_amount = json_decode(Config::KeyValue('acquisition_items_and_amount')->value, true);
		$acquisition_items = array_keys($acquisition_items_and_amount);
		foreach($acquisition_items as $item_id)
		{
			$amount_required = $acquisition_items_and_amount[$item_id];
			$amount_fulfilled = 0;
			$bids = Acquisition::where('year', $year)->where('resource_id', $item_id)->where('status', 'submitted')->orderBy('price', 'asc')->oldest()->get();
			foreach($bids as $bid)
			{
				$transaction_amount = 0;
				if($amount_required - $amount_fulfilled >= $bid->amount)
				{
					$amount_fulfilled += $bid->amount;
					$transaction_amount = $bid->amount;
					$bid->status = 'successful';
				}
				else
				{
					$amount_successful = $amount_required - $amount_fulfilled;
					$amount_fulfilled = $amount_required;
					$transaction_amount = $amount_successful;
					$bid->status = "partially successful ($amount_successful successful)";
				}
				$bid->save();
				$seller = $bid->user;
				$sellerItem = $seller->resources()->resid($bid->resource_id)->first();
				$sellerAmount = $transaction_amount;
				$buyer = User::type(0)->first();
				$buyerItem = $buyer->resources()->resid(1)->first();
				$buyerAmount = $bid->price;
				event(new NewTransaction($buyer, $seller, $buyer, $sellerItem, $buyerItem, $sellerAmount, $buyerAmount, 'acquisition'));
				if($amount_fulfilled == $amount_required)
				{
					break;
				}
			}
			Acquisition::where('year', $year)->where('resource_id', $item_id)->where('status', 'submitted')->update(['status' => 'unsuccessful']);//reject the rest: sorry, bye!
		}
		return redirect()->back();
	}
}
