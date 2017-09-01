<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\Resources;
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
		return view('resources.individual')->with('resource', Resources::query()->where('id',$request->id)->firstOrFail());
	}
}
