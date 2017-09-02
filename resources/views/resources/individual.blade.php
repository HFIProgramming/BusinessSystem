@extends('layouts.base')

@section('title')
    New Transaction
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
                        Specific Resource List
                    </div>
                </div>


                <div class="mdui-card-content mdui-typo">
                    <br>
                    <div class="mdui-table-fluid">
                        <table class="mdui-table">
                            <thead>
                            <tr>
                                <th>需要的物品</th>
                                <th>需要的物品数量</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (!empty($resource->requirement))
                            @foreach($resource->requirement as $key => $value)
                                <tr>
                                    <td>{{$key}}</td>
                                    <td>{{$value}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            @else
                                <tr>
                                    <td>没有需求</td>
                                    <td>空</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>


            <!--row-->
        </div>
@endsection
