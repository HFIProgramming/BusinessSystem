@extends('layouts.error')

@section('title')
    404 No Found
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
                        喵呜？
                    </div>
                </div>

                <div class="adjust_card_subtitle mdui-card-header-subtitle">
                    <div class="mdui-text-center">
                        出错了
                    </div>
                </div>
                <div class="mdui-card-content mdui-typo mdui-center">
                    走错路了吧骚年？这里什么都没有
                    <button class="mdui-btn mdui-color-theme mdui-ripple" onclick="window.history.back()">返回上一层</button>
                </div>
            </div>
            <!--row-->
        </div>
    </div>
@endsection
