@extends('layouts.admin')

@section('title')
    Company Stats
@endsection

@section('script')

@endsection

@section('stylesheet')

@endsection

@section('body')
    <div class="mdui-container doc-container">
        <div class="mdui-row">
            <div class="adjust_card mdui-col-xs-12">

                <div class="mdui-card-header">
                    <div class="mdui-typo-display-2 mdui-text-center mdui-text-color-theme">
                        Company Stats
                    </div>
                </div>

                <div class="mdui-card-header-subtitle adjust_card_subtitle">
                    <div class="mdui-text-center">
                        便捷金融生活从此开启
                    </div>
                </div>
                <div class="mdui-card-content mdui-typo">
                    <br>
                    <div class="mdui-table-fluid">
                        <table class="mdui-table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>股票总市值</th>
                                <th>总资金</th>
                                <th>建筑</th>
                                <th>欠款</th>
                                <th>总计</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($companies as $company)
                                <tr>
                                    @php
                                        $sum = 0
                                    @endphp
                                    <td>{{$company->id}}({{$company->name}})</td>
                                    <td>{{$market_value = $company->stock->current_price * $company->stock->total}}</td>
                                    <td>{{$money = $company->user->resources()->resid(1)->first()->amount}}</td>
                                    <td>
                                        <ul class="mdui-list">
                                            @foreach($company->user->resources as $userResource)
                                                @if($userResource->resource->type == 2)
                                                    <li class="mdui-list-item">{{ $userResource->resource->name }}
                                                        :{{ $userResource->amount }}
                                                        * {{ $userResource->resource->acquisition_price }}00000000</li>
                                                    @php
                                                        $sum += $userResource->amount * $userResource->resource->acquisition_price * 100000000
                                                    @endphp
                                                @endif
                                            @endforeach
                                            <li class="mdui-list-item">总计: {{$sum}}</li>
                                        </ul>
                                    </td>
                                    <td>{{$unredeemed = \App\Loan::where('debtor_id', $company->user_id)->where('status', 'accepted')->get()->sum('amount')}}</td>
                                    <td>{{ $total = $market_value + $money + $sum - $unredeemed }}({{round($total/100000000,2)}}亿)</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <!--row-->
        </div>
    </div>
@endsection
