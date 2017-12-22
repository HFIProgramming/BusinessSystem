<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\Resources;
use App\Transaction;
use App\Zone;
use Illuminate\Http\Request;

class HomeController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
	}

	public function index()
	{
		return view('welcome');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function showResource()
	{
		return view('resources.list')->with('resources', Resources::all());
	}

	public function showAnnouncement()
	{
		return view('announcements.index')->with('announcements', Announcement::all());
	}

	public function showIndividualResource(Request $request)
	{
		return view('resources.individual')->with('resource', Resources::query()->where('id', $request->id)->firstOrFail());
	}

	public function showErrorPage()
	{
		return view('errors.custom');
	}

	public function showBills(Request $request)
    {
        $transactions = Transaction::where('buyer_id', $request->user()->id)->where(function ($query){
            $query->where('type', 'yearly_yield')->orWhere('type', 'stock_dividend');
        })->get();
        return view('bills.list')->with('transactions', $transactions);
    }

    public function showZones()
    {
        return view('zones')->with('zones', Zone::all());
    }
}
