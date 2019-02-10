<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Config;
use App\Acquisition;
use App\Resources;

class AcquisitionController extends Controller
{
	//
	public function showBidForm(Request $request)
	{
		$user = $request->user();
		$year = Config::KeyValue('current_round')->value;
		if(Config::KeyValue('acquisition_activated') == 1)
		{
			if(empty($user->acquisitions()->where('year', $year)->first()))
			{
				$acquisition_item_and_amount = json_decode(Config::KeyValue('acquisition_items_and_amount')->value, true);
				return view('acquisition.createBids')->with('year', $year)->with('acquisition_items_and_amount', $acquisition_items_and_amount);
			}
			return view('errors.custom')->with('message', '本财年已经提交过竞标啦');
		}
		return view('errors.custom')->with('message', '目前不能投标呢！');
	}

	public function listBids(Request $request)
	{
		$user = $request->user();
		$bids = $user->acquisitions()->latest()->get();
		return view('acquisition.list')->with('bids', $bids);
	}

	public function submitBids(Request $request) // Need a json array $request->bids
	{
		$user = $request->user();
		$bids = $request->input('bids');
		$year = Config::KeyValue('current_round')->value;
		foreach($bids as $resource_id => $data)
		{
			if($user->resources()->resid($resource_id)->first()->amount < $data['amount'])
			{
				return view('errors.custom')->with('message', '没那么多东西可卖诶');
			}
		}
		foreach($bids as $resource_id => $data)
		{
			$user->acquisitions()->create([
				'year' => $year,
				'resource_id' => $resource_id,
				'price' => $data['price'],
				'amount' => $data['amount'],
				'status' => 'submitted'
			]);
		}
		return view('success')->with('message', '投标成功');
	}
}
