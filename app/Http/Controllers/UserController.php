<?php

namespace App\Http\Controllers;

use App\Announcement;
use Illuminate\Http\Request;

class UserController extends Controller
{
	//
	public function __construct()
	{
	}

	public function index(Request $request)
	{
		return view('dashboard')
			->with('user', $request->user())
			->with('announcement', Announcement::all()->sortByDesc('id')->first());
	}

}
