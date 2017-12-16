<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoanController extends Controller
{
    //
    //@TODO 贷款方限制
    public function grantLoan(Request $request)
    {
        $debtor_id = $request->debtor_id;
        $amount = $request->amount;
        $interest = $request->interest;
        $creditor = $request->user();
        if(empty($debtor = User::find($debtor_id)))
        {
            return view('errors.custom')->with('message', '不支持给冥界放款哦 请检查对方ID是否正确');//@TODO 这页面丑死了 有空换一个吧
        }
        if($debtor->resources()->resid(1)->first()->amount < $amount)
        {
            return view('errors.custom')->with('message', '不够钱还是先别放款了吧');
        }
    }

    public function acceptLoan(Request $request)
    {

    }
}
