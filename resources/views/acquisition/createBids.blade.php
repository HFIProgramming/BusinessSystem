@extends('layouts.base')

@section('title')
    robots bidding
@endsection

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

@section('stylesheet')

@endsection

@section('body')
    <div class="mdui-container doc-container">
        <div class="mdui-row">
            <div class="mdui-col-xs-12">
                <div class="mdui-card">
                    <div class="mdui-card-header">
                        <div class="mdui-typo-display-2 mdui-text-center mdui-text-color-theme">
                            收购机器人的投标
                        </div>
                    </div>
                    <div class="mdui-card-header-subtitle adjust_card_subtitle">
                        <div class="mdui-text-center">
                            便捷金融生活从此开启
                        </div>
                    </div>

                    <div class="mdui-card-content mdui-typo">
                        <form enctype="application/json" method="post" action="{{route('submitAcquisitionBids')}}">
                        <table class="mdui-table">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>数量</th>
                                <th>出价</th>
                            </tr>
                            </thead>
                            <tbody>
                                {{ csrf_field() }}
                                @foreach($acquisition_items_and_amount as $item => $amount)
                                    <tr>
                                        <td>{{$item}}</td>
                                        <td>
                                            <div class="mdui-textfield mdui-textfield-floating-label">
                                                <label class="mdui-textfield-label">主席团准备购入{{$amount}}个</label>
                                                <input class="mdui-textfield-input" name="bids[{{ $item }}][amount]" type="number"/>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="mdui-textfield mdui-textfield-floating-label">
                                                <label class="mdui-textfield-label">我的出价</label>
                                                <input class="mdui-textfield-input" name="bids[{{ $item }}][price]" type="number"/>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button data-no-instant type="submit" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme mdui-center">
                            提交
                        </button>
                        </form>
                    </div>
                </div>
            </div>

            <!--row-->
        </div>
    </div>
@endsection