<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request;
use App\Bank;
use App\Company;
use App\Http\Controllers\Controller;
use App\User;
use App\Resources;
use App\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function showCompanyStats()
    {
        return view('admin.company_stat')->with('companies', Company::all());
    }

    public function showBankStats()
    {
        return view('admin.bank_stat')->with('banks', Bank::all());
    }

    public function godLogin(Request $request)
    {
        Auth::loginUsingId($request->id);
    }

    public function setTax(Request $request)
    {
        $south = $request->south;
        $north = $request->north;
        $south_zone = Zone::find(1);
        $south_zone->tax = $south;
        $north_zone = Zone::find(2);
        $north_zone->tax = $north;
        $south_zone->save();
        $north_zone->save();
        return ['success', $south_zone, $north_zone];
    }
}
