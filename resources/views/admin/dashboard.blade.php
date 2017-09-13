@extends('layouts.admin')

@section('title')
    Admin Panel
@endsection

@section('script')

@endsection

@section('stylesheet')

@endsection

@section('body')
    <div class="mdui-container doc-container">

        <div class="mdui-card mdui-col-xs-3">

            <div class="mdui-card-header">
                <div class="mdui-card-primary-title">总转账数</div>
            </div>
            <br>
            <div class="mdui-card-content">
                <div class="mdui-typo-subheading">以下为更新的总转账数：</div>
                <ul class="mdui-list">
                    <li class="mdui-list-item mdui-ripple">{{\App\Transaction::all()->count()}}</li>
                </ul>
            </div>
        </div>

        <div class="mdui-card mdui-col-xs-3">

            <div class="mdui-card-header">
                <div class="mdui-card-primary-title">总资源数</div>
            </div>
            <br>
            <div class="mdui-card-content">
                <div class="mdui-typo-subheading">以下为更新的总资源数：</div>
                <ul class="mdui-list">
                    <li class="mdui-list-item mdui-ripple">{{\App\Resources::all()->count()}}</li>
                </ul>
            </div>
        </div>

        <div class="mdui-card mdui-col-xs-3">

            <div class="mdui-card-header">
                <div class="mdui-card-primary-title">总人数</div>
            </div>
            <br>
            <div class="mdui-card-content">
                <ul class="mdui-list">
                    <li class="mdui-list-item mdui-ripple">{{\App\User::all()->count()}}</li>
                </ul>
            </div>
        </div>

        <div class="mdui-card mdui-col-xs-3">

            <div class="mdui-card-header">
                <div class="mdui-card-primary-title">当前财年</div>
            </div>
            <br>
            <div class="mdui-card-content">

                <ul class="mdui-list">
                    <li class="mdui-list-item mdui-ripple">{{\App\Config::KeyValue('current_round')->value}}</li>
                </ul>
            </div>
        </div>

        <div class="mdui-card mdui-col-xs-3">

            <div class="mdui-card-header">
                <div class="mdui-card-primary-title">总公告数</div>
            </div>
            <br>
            <div class="mdui-card-content">
                <div class="mdui-typo-subheading">以下为更新的总公告数：</div>
                <ul class="mdui-list">
                    <li class="mdui-list-item mdui-ripple">{{\App\Announcement::all()->count()}}</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
