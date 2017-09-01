@extends('layouts.base')

@section('title')
    New Transaction
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
    <div class="mdui-row">
        <div class="mdui-col-xs-12">
            <div class="mdui-card">
                <div class="mdui-card-header">
                    <div class="mdui-typo-display-2 mdui-text-center mdui-text-color-theme">
                        New Upgrade
                    </div>
                </div>
                <div class="mdui-card-header-subtitle adjust_card_subtitle">
                    <div class="mdui-text-center">
                        便捷金融生活从此开启
                    </div>
                </div>
                <div class="mdui-card-content mdui-typo">
                    <form>
                        <div class="mdui-textfield mdui-textfield-floating-label">
                            <i class="mdui-icon material-icons adjust_mdui_icon">shopping_basket</i>
                            <label class="mdui-textfield-label">目标商品</label>
                            <input class="mdui-textfield-input" type="text" required/>
                            <div class="mdui-textfield-error">目标商品不能为空</div>
                        </div>
                        <div class="mdui-textfield mdui-textfield-floating-label ">
                            <i class="mdui-icon material-icons adjust_mdui_icon">add</i>
                            <label class="mdui-textfield-label">购买数量</label>
                            <input class="mdui-textfield-input" type="number" required/>
                            <div class="mdui-textfield-error">购买数量不能为空</div>
                        </div>
                        <button class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme mdui-center">提交</button>
                    </form>
                </div>
            </div>
        </div>

        <!--row-->
    </div>
@endsection
