<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Resources;

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
        foreach (User::all() as $user) {
            foreach (Resources::all() as $resource) {
                if (empty($user->resources()->resid($resource->id)->first())) {
                    $user->resources()->create([
                        'resource_id' => $resource->id,
                        'user_id' => $user->id,
                        'amount' => 0,
                    ]);
                }
            }
        }
        return 'Success';
    }
}
