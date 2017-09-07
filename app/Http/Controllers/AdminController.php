<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{
	//
	public function __construct()
	{
	}

	public function showDashboard()
	{
		return view('admin.dashboard');
	}

	public function refreshUserResource()
    {
        foreach(User::all() as $user) {
            foreach(Resource::all() as $resource) {
                if(empty($user->resources()->resid($resource->id)->first())) {
                    $user->resources()->create([
                        'resource_id' => $resource->id,
                        'user_id'     => $user->id,
                        'amount'      => 0,
                    ]);
                }
            }
        }
    }
}
