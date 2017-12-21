<?php

namespace App\Http\Controllers;

use App\Config;
use App\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function getCompanyReports(Request $request)
    {
        $companyReports = [];
        $current_round = Config::KeyValue('current_round')->value;
        for($i = 1; $i <= $current_round; $i++)
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
                $array['total'] = $company->stock->total;
                $array['stock_price'] = $rawReport->stock_price;
                $array['last_profit'] = $rawReport->profit;
            }
        }
    }
}
