@extends('layouts.base')

@section('title')
    Company Report
@endsection


@section('stylesheet')
    <style>
        .doc-container {
            padding-top: 30px;
            padding-bottom: 150px;
        }

        .mdui-tab {
            min-width: 40px;
        !important;
        }

        .company {
            padding: 10px;
        !important;
        }
    </style>
@endsection

@section('body')
    <div class="mdui-container doc-container">
        <div id="title">
            <div class="mdui-center mdui-typo-display-1 mdui-text-center mdui-text-color-theme">
               公司报表
            </div>
        </div>
        <div class="mdui-tab mdui-tab-scrollable" mdui-tab>
            @foreach($companyReports as $companyReport)
                <a class="mdui-ripple" onclick="display()"
                   id="{{$companyReport['year']}}">{{$companyReport['year']}}</a>
            @endforeach
        </div>
        <br><br>

        {{--<canvas id="test"></canvas>--}}

        @foreach($companyReports as $companyReport)
            <div id="table-{{$companyReport['year']}}" class="cardId mdui-col-md-12">
                @foreach($companyReport['info'] as $company)
                    <div class="company mdui-col-md-12">
                        <div class="mdui-card">
                            <div class="mdui-card-primary">
                                <div class="mdui-card-primary-title">{{$company['name']}}</div>
                            </div>
                            <div class="mdui-card-content">
                                <ul class="mdui-list">
                                    <li class="mdui-list-item mdui-ripple">当年利润（税前）：{{$company['last_profit']}}</li>
                                    <li class="mdui-list-item mdui-ripple">
                                        公司持有的建筑：
                                        <ul class="mdui-list">
                                            @foreach($company['buildings'] as $building)
                                                <li class="mdui-list-item mdui-ripple">{{$building['name']}}
                                                    （数量：{{$building['amount']}}）
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li class="mdui-list-item mdui-ripple">欠款未还：{{$company['unredeemed_loan']}}</li>
                                    <li class="mdui-list-item mdui-ripple">当年税率：{{100*$company['tax']}}%</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @endforeach

    </div>

    {{--@endforeach--}}
    {{--</div>--}}
@endsection
