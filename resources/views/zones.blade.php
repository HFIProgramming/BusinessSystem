@extends('layouts.base')

@section('title')
    Zone List
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
                        Zone List
                    </div>
                </div>


                <div class="mdui-card-content mdui-typo">
                    <br>
                    <div class="mdui-table-fluid">
                        <table class="mdui-table">
                            <thead>
                            <tr>
                                <th>名称</th>
                                <th>电力指数</th>
                                <th>幸福指数</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($zones as $zone)
                                <tr>
                                    <td>{{$zone->name}}</td>
                                    <td>{{$zone->powerIndex()}}</td>
                                    <td>{{$zone->happinessIndex()}}</td>
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
