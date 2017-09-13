<?php

namespace App\Http\Controllers\Auth;

use App\Config;
use App\Resources;
use App\Technology;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use phpDocumentor\Reflection\Types\Parent_;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'type' => 'required|numeric|min:1|max:2',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::query()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'type' => $data['type'],
        ]);
        $user->resources()->create([
            'resource_id' => 1, //money
            'user_id' => $user->id,
            'amount' => Config::KeyValue('startup_fund_' . $data['type'])->value,
        ]);
        foreach (Resources::all() as $resource) {
            if ($resource->id != 1) {
                //not money
                $user->resources()->create([
                    'resource_id' => $resource->id, //money
                    'user_id' => $user->id,
                    'amount' => 0,
                ]);
            }
        }
        for ($t = 0; $t <= 1; $t++) {
            Technology::create([
                'user_id' => $user->id,
                'type' => $t,
                'level' => 1
            ]);
        }
        return $user;
    }

}
