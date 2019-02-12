<?php

namespace App\Http\Controllers;

use App\Bank;
use App\Config;
use App\Report;
use App\Zone;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function showCompanyReports(Request $request)
    {
        $companyReports = [];
        $current_round = Config::KeyValue('current_round')->value;
        for($i = 0; $i <= $current_round; $i++)
        {
            $companyReport = [];
            $companyReport['year'] = $i;
            $companyReport['info'] = [];
            foreach(Report::where('type', 'company')->where('year', $i)->get() as $rawReport)
            {
                $company = $rawReport->user->company;
                $array = [];
                $array['name'] = $company->name;
                $array['id'] = $company->id;
                $array['last_profit'] = $rawReport->profit;
                $array['buildings'] = $rawReport->buildings;
                $array['unredeemed_loan'] = $rawReport->unredeemed_loan;
                $array['tax'] = Zone::find($company->user->type)->tax;
                array_push($companyReport['info'], $array);
            }
            if(!empty($companyReport['info'])) {
                array_push($companyReports, $companyReport);
            }
        }
//        return $companyReports;

        return view('report.company')->with('companyReports', $companyReports);
    }

    public function showBankReports()
    {
        $bankReports = [];
        $current_round = Config::KeyValue('current_round')->value;
        for($i = 0; $i <= $current_round; $i++)
        {
            $banksYearlyReport = [];
            $banksYearlyReport['year'] = $i;
            $banksYearlyReport['data'] = [];
            foreach(Report::where('type', 'bank')->where('year', $i)->get() as $rawReport)
            {
                $bank = $rawReport->user->bank;
                $individualReport = [
                    'name' => $bank->name,
                    'id' => $bank->id,
                    'components' => $rawReport->components,
                    'loan_total' => $rawReport->loan_total
                ];
                array_push($banksYearlyReport['data'], $individualReport);
            }
            if(!empty($banksYearlyReport['data'])) {
                array_push($bankReports, $banksYearlyReport);
            }
        }

//        return $bankReports;

        return view('report.bank')->with('bankReports', $bankReports);
    }
}
