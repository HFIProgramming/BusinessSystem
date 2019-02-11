@extends('layouts.base')

@section('title')
    Player Bidding
@endsection

@section('script')

@endsection

@section('stylesheet')

@endsection

@section('body')
    <div class="mdui-container doc-container">
        <div class="mdui-row">
            <div class="mdui-col-xs-12">
                <div class="mdui-card">
                    <div class="mdui-card-header">
                        <div class="mdui-typo-display-2 mdui-text-center mdui-text-color-theme">
                            选手竞价表格
                        </div>
                    </div>
                    <div class="mdui-card-header-subtitle adjust_card_subtitle">
                        <div class="mdui-text-center">
                            便捷金融生活从此开启
                        </div>
                    </div>

                    <div class="mdui-card-content mdui-typo">
                        目前是第{{$year}}财年
                        <br>
                        目前供拍卖的一共有{{$auction_amount}}件
                        <br>
                        <form method="post" action="{{route('newBidding')}}">
                            {{ csrf_field() }}
                            <div class="mdui-textfield mdui-textfield-floating-label">
                                <i class="mdui-icon material-icons adjust_mdui_icon">shopping_basket</i>
                                <label class="mdui-textfield-label">我的出价</label>
                                <input class="mdui-textfield-input" id="bidding_amount" name="bidding_amount" type="number" required/>
                                <div class="mdui-textfield-error">我的商品不能为空</div>
                            </div>
                            <button data-no-instant class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme mdui-center">提交
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!--row-->
        </div>
    </div>
@endsection
