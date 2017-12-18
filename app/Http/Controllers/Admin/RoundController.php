<?php

namespace App\Http\Controllers\Admin;

use App\Events\EndOfYear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Config;

class RoundController extends Controller
{
	//
	public function show(Request $request)
	{
		return view('admin.fiscal_year')->with('current', Config::KeyValue('current_round')->value)
			->with('total', Config::KeyValue('total_round')->value);
	}

	public function changeTotal(Request $request)
	{
		$total = Config::KeyValue('total_round');
		$total->value = $request->total_round;
		$total->save();

		return redirect()->back();
	}

	public function changeCurrent(Request $request)
	{
		if ($request->increment != NULL) {
			$current = Config::KeyValue('current_round');
			$current->value += $request->increment;
			$current->save();
		} elseif ($request->condition != NULL) {
			$condition = Config::KeyValue('is_continued');
			$condition->value = $request->condition;
			$condition->save();
			if($request->condition == '0')
            {
                event(new EndOfYear(Config::KeyValue('current_round')->value));
            }
		}

		return redirect()->back();
	}
}
