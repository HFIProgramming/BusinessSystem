<?php

namespace App\Http\Controllers\Admin;

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
        $current = Config::KeyValue('current_round');
        $current->value += $request->increment;
        $current->save();
        return redirect()->back();
    }
}
