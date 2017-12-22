<?php

namespace App\Http\Controllers\Auth;

use App\Company;
use App\Config;
use App\Events\NewResource;
use App\Events\StockTotalChange;
use App\Resources;
use App\Stock;
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
        if($data['type'] != 1 && $data['type'] !=2)
        {
            return view('errors.custom')->with('message', '不能注册此类型账号');
        }
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
        if ($user->type == 1)//Company
        {
            $company = $user->company()->create([
                'name' => $user->name,
                'last_year_profit' => 700000000 //to be determined
            ]);
            $stockResource = Resources::create([
                'code' => $user->name . '_stock',
                'name' => $user->name . '公司股票',
                'description' => $user->name . '公司股票',
                'type' => 3
            ]);

            $stock = Stock::create([
                'current_price' => 20,
                'history_prices' => [],
                'total' => 1000000000,
                'dividend' => 0.1,
                'up_poly_coeff' => [2, 1],
                'down_poly_coeff' => [-2, 1],
                'sell_remain' => 112500000,
                'buy_remain' => 112500000,
                'company_id' => $company->id,
                'resource_id' => $stockResource->id
            ]);
            event(new NewResource());
            event(new StockTotalChange($stock, $stock->total));
        }
        else if ($user->type == 2)//Bank
        {
            $bank = $user->bank()->create([
               'name' => $user->name
            ]);
        }
        return $user;
    }

}
