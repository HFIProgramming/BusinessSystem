<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Config;

class RoundController extends Controller
{
    //
    public function showCurrent(Request $request)
    {
        return view('admin.year')->with('current', Config::KeyValue('current_round')->value)
            ->with('total', Config::KeyValue('total_round')->value);
    }

    public function changeTotal(Request $request)
    {
        $total = Config::KeyValue('total_round');
        $total->value = $request->total_round;
        $total->save();
    }

    public function changeCurrent(Request $request)
    {
        $current = Config::KeyValue('current_round');
        $current->value += $request->increment;
        $current->save();
    }
}
