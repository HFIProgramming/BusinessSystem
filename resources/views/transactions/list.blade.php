@extends('layouts.base')

@section('title')
    Transaction List
@endsection

@section('script')

@endsection

@section('stylesheet')
    <style>
        /*.adjust_card {*/
        /*padding-top: 100px;*/
        /*padding-bottom: 200px;*/
        /*}*/

        .adjust_card_subtitle {
            margin-left: 0;
        }

        /*.adjust_remember {*/
        /*margin-left: 9px;*/
        /*}*/

        .adjust_mdui_icon {
            bottom: 33px !important;
        }
    </style>
@endsection

@section('body')
    <div class="mdui-container doc-container">
        <div class="mdui-row">
            <div class="mdui-col-xs-12">

                <div class="mdui-card-header">
                    <div class="mdui-typo-display-2 mdui-text-center mdui-text-color-theme">
                        Resource List
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
                                <th>入商品</th>
                                <th>入数量</th>
                                <th>出商品</th>
                                <th>出数量</th>
                                <th>交易方</th>
                                <th>时间</th>
                                <th>状态</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($incomeTransactions as $transaction)
                            <tr>
                                <td>{{$transaction->id}}</td>
                                <td>{{$transaction->}}</td>
                                <td>入商品数量</td>
                                <td>出商品名</td>
                                <td>出商品数量</td>
                                <td>交易方名</td>
                                <td>18:00</td>
                                <td>
                                    <button class="mdui-btn mdui-color-theme mdui-ripple">确认</button>
                                </td>
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
