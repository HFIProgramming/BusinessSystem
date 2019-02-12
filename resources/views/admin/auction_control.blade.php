@extends('layouts.admin')

@section('script')
    <script type="text/javascript">
        var arry = $("#robotBidding").serializeArray();

        $.ajax({
            url: "/Login/Index",
            data: { jsondata: JSON.stringify(arry) },
            type:"post",
            success: function () {
                alert("success");
            }
        });

    </script>
@endsection

@section('body')
<div class="mdui-container doc-container">
    <div class="mdui-row">
        <div class="mdui-col-xs-12">
            <br><br>

            <div class="mdui-col-xs-12 mdui-card">
                <br>
                <div class="mdui-card-header">
                    <div class="mdui-typo-display-2 mdui-text-center mdui-text-color-theme">
                        幕后黑手
                    </div>
                </div>
                <div class="mdui-card-header-subtitle adjust_card_subtitle">
                    <div class="mdui-text-center">
                        便捷金融生活从此开启
                    </div>
                </div>>

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
                    <form method="post" action="{{ route('setAuctionStatus') }}">
                        {{ csrf_field() }}
                        <button type="submit" name="status" value="1"
                        class="mdui-btn mdui-btn-raised mdui-color-theme-accent mdui-ripple mdui-col-offset-xs-1">
                        <i class="mdui-icon material-icons">keyboard_arrow_right</i>
                        开始
                    </button>
                    <button type="submit" name="status" value="0"
                    class="mdui-btn mdui-btn-raised mdui-color-theme-accent mdui-ripple mdui-col-offset-xs-1">
                    <i class="mdui-icon material-icons">keyboard_arrow_right</i>
                    结束
                </button>
            </form>
        </div>
        <br><br>

        <br><br><br>
        <form method="post" action="{{ route('setAuctionAmount') }}">
            {{ csrf_field() }}
            <div class="mdui-textfield mdui-textfield-floating-label mdui-col-offset-xs-1">
                <label class="mdui-textfield-label">拍卖数量</label>
                <input class="mdui-textfield-input" name="amount" type="number"/>
            </div>
            <div>
                <br><br>
                <button type="submit" class="mdui-btn mdui-btn-raised mdui-ripple mdui-col-offset-xs-1">
                    确定
                </button>
            </div>
        </form>
        <br><br>

        <div>
            <br><br>
            <button href="{{ route('doAuctionTransactions') }}"
            class="mdui-btn mdui-btn-raised mdui-color-theme-accent mdui-ripple mdui-col-offset-xs-1">
            <i class="mdui-icon material-icons">exit_to_app</i>
            清算
            </button>
        </div>
    <br><br>

    <div class="mdui-text-center">
       竞标情况
   </div>

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
@endsection