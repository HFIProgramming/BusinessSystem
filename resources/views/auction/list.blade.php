@extends('layouts.base')

@section('title')
    拍卖列表
@endsection

@section('script')

@endsection

@section('stylesheet')

@endsection

@section('body')
    <div class="mdui-container doc-container">
        <div class="mdui-row">
            <div class="mdui-col-xs-12">

                    <div class="mdui-card-header">
                        <div class="mdui-typo-display-2 mdui-text-center mdui-text-color-theme">
                            拍卖列表
                        </div>
                    </div>



                    <div class="mdui-card-content mdui-typo">
                        <br>
                        <div class="mdui-table-fluid">
                            <table class="mdui-table">
                                <thead>
                                <tr>
                                    <th>财年</th>
                                    <th>出价</th>
                                    <th>状态</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($bids as $bid)
                                    <tr>
                                        <td>{{$bid->year}}</td>
                                        <td>{{$bid->price}}</td>
                                        <td>{{$bid->status}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <br>
                </div>
            </div>
        </div>
    </div>
        <!--row-->

@endsection
