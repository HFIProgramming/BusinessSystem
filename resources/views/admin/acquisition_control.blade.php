@extends('layouts.admin')

@section('body')
    <div class="mdui-container doc-container">
        <div class="mdui-row">
            <div class="mdui-col-xs-12">
                <br><br>

                <div class="mdui-col-xs-12 mdui-card">
                    <br>
                    <div class="mdui-card-header">
                        <div class="mdui-typo-display-2 mdui-text-center mdui-text-color-theme">
                            控制收购状态
                        </div>
                    </div>
                    <div class="mdui-card-header-subtitle adjust_card_subtitle">
                        <div class="mdui-text-center">
                            便捷金融生活从此开启
                        </div>
                    </div>>

                    <div class="mdui-text-center">
                        现在是第{{$year}}财年
                    </div>

                    <div class="mdui-text-center">
                        @if($status == 1)
                            目前正在拍卖
                        @endif
                        @if($status == 0)
                            目前不在拍卖哦~
                        @endif
                    </div>

                    <div class="mdui-text-center">
                        <br><br>
                        <form method="post" action="{{ route('startend') }}">
                            {{ csrf_field() }}
                            <button type="submit" name="condition" value="1"
                                    class="mdui-btn mdui-btn-raised mdui-color-theme-accent mdui-ripple mdui-col-offset-xs-1">
                                <i class="mdui-icon material-icons">keyboard_arrow_right</i>
                                开始
                            </button>
                            <button type="submit" name="condition" value="0"
                                    class="mdui-btn mdui-btn-raised mdui-color-theme-accent mdui-ripple mdui-col-offset-xs-1">
                                <i class="mdui-icon material-icons">keyboard_arrow_right</i>
                                结束
                            </button>
                        </form>
                    </div>
                    <br><br>


                    <div class="mdui-text-center">
                        <a class=" mdui-btn mdui-btn-raised mdui-color-theme-accent mdui-ripple mdui-col-xs-2 mdui-col-offset-xs-5" href="{{ route('submitYear') }}"> 财年清算 </a>
                    </div>
                    <br><br><br>
                    <form method="post" action="{{ route('claer') }}">
                        {{ csrf_field() }}
                        <div>
                            <br><br>
                            <button type="submit" name="clear" value="1"
                                    class="mdui-btn mdui-btn-raised mdui-color-theme-accent mdui-ripple mdui-col-offset-xs-1">
                                <i class="mdui-icon material-icons">exit_to_app</i>
                                清算
                            </button>
                        </div>
                    </form>
                    <br><br>

                    <div class="mdui-text-center">
                        收购状态
                    </div>

                    <br>
                    <div class="mdui-table-fluid">
                        <table class="mdui-table">
                            <thead>
                            <tr>
                                <th>item</th>
                                <th>amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            <form method="post" action="{{ route('呃不知道是啥') }}">
                                {{ csrf_field() }}
                            @foreach($aquisition_items_and_amount as $item_id => $amount)
                                    <tr>
                                        <td>{{$item}}</td>
                                        <input type="hidden" id="itemId" name="itemId" value="{{$item}}">
                                        <td>
                                            <div class="mdui-textfield mdui-textfield-floating-label">
                                                <i class="mdui-icon material-icons adjust_mdui_icon">shopping_basket</i>
                                                <label class="mdui-textfield-label">id</label>
                                                <input class="mdui-textfield-input" id="item_id" name="item_id" type="number"/>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="mdui-textfield mdui-textfield-floating-label">
                                                <i class="mdui-icon material-icons adjust_mdui_icon">shopping_basket</i>
                                                <label class="mdui-textfield-label">amount</label>
                                                <input class="mdui-textfield-input" id="amount" name="amount" type="number"/>
                                            </div>
                                            <button data-no-instant class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme mdui-center">
                                                提交
                                            </button>
                                        </td>
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
@endsection