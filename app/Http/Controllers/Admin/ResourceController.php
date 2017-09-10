<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Resources;

class ResourceController extends Controller
{
    //
    public function listBots(Request $request)
    {
        $bots = Resources::where('type', 3)->get();
        return view('admin.acquisition_price_list')->with('bots', $bots);
    }

    public function updateBots(Request $request)
    {
        $bots = $request->bots;
        foreach($bots as $id => $acq_price)
        {
            if($bot = Resources::find($id))
            {
                $bot->acquisition_price = $acq_price;
                $bot->save();
            }
        }
        return view('success')->with('message', '👌ojbk!');
    }

    public function listMiners(Request $request)
    {
        $miners = Resources::where('type', 4)->get();
        return view('admin.employment_price_list')->with('miners', $miners);
    }

    public function updateMiners(Request $request)
    {
        $miners = $request->miners;
        foreach($miners as $id=>$emp_price)
        {
            if($miner = Resources::find($id))
            {
                $miner->employment_price = $emp_price;
                $miner->save();
            }
        }
        return view('success')->with('message', '👌ojbk!');
    }
}
