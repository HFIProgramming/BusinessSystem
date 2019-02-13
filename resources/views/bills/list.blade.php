@extends('layouts.base')

@section('title')
    Bills List
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
                        年终入账
                    </div>
                </div>


                <div class="mdui-card-content mdui-typo">
                    <br>
                    <div class="mdui-table-fluid">
                        <table class="mdui-table">
                            <thead>
                            <tr>
                                <th>名称</th>
                                <th>数量</th>
                                <th>入账时间</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($transactions as $trans)
                                <tr>
                                    <td>{{$trans->sellerResource->resource->name}}</td>
                                    <td>{{$trans->seller_amount}}</td>
                                    <td>{{$trans->created_at}}</td>
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
