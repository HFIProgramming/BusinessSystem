@extends('layouts.base')

@section('title')
    Build
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
                        Build
                    </div>
                </div>

                <div class="mdui-card-header-subtitle adjust_card_subtitle">
                    <div class="mdui-text-center">
                        便捷金融生活从此开启
                    </div>
                </div>
                <div class="mdui-card-content mdui-typo">
                    <form method="post" action="{{route('build')}}">
                        {{ csrf_field() }}
                        <div class="mdui-textfield mdui-textfield-floating-label">
                            <i class="mdui-icon material-icons adjust_mdui_icon">shopping_basket</i>
                            <label class="mdui-textfield-label">建筑ID</label>
                            <input class="mdui-textfield-input" id="itme_id" name="item_id" type="text" required/>
                            <div class="mdui-textfield-error">建筑ID不能为空</div>
                        </div>
                        <div class="mdui-textfield mdui-textfield-floating-label ">
                            <i class="mdui-icon material-icons adjust_mdui_icon">account_circle</i>
                            <label class="mdui-textfield-label">数量</label>
                            <input class="mdui-textfield-input" id="amount" name="amount" type="number" required/>
                            <div class="mdui-textfield-error">数量不能为空</div>
                        </div>
                        <button data-no-instant type="submit" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme mdui-center">提交
                        </button>
                    </form>
                </div>
            </div>


            <!--row-->
        </div>
    </div>
@endsection
