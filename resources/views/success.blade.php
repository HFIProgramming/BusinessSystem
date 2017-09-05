@extends('layouts.error')

@section('title')
    Success
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
                        哇喔？
                    </div>
                </div>

                <div class="mdui-card-header-subtitle adjust_card_subtitle">
                    <div class="mdui-text-center">
                        您的操作已经完成，请检查
                    </div>
                </div>
                <div class="mdui-card-content mdui-typo">
                    @if(!empty($message))
                        {{$message}}
                    @else
                        操作完成，如有疑问请联系管理员
                    @endif
                    <button class="mdui-btn mdui-color-theme mdui-ripple" onclick="window.history.back()">返回上一层</button>
                </div>
            </div>
            <!--row-->
        </div>
    </div>
@endsection
