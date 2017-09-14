<?php

namespace App\Http\Controllers\Admin;

use App\Logs;
use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogController extends Controller
{
	//

	public function showLogs()
	{
		return view('admin.logs')->with('logs', Logs::with('user')->orderByDesc('created_at')->get());
	}
}
