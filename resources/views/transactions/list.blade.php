@extends('layouts.base')

@section('title')
    交易列表
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
                        交易列表
                    </div>
                </div>



                <div class="mdui-card-content mdui-typo">
                    <br>
                    <div class="mdui-table-fluid">
                        <table class="mdui-table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>入商品</th>
                                <th>入数量</th>
                                <th>出商品</th>
                                <th>出数量</th>
                                <th>交易方</th>
                                <th>时间</th>
                                <th>状态</th>
                                <th>更新时间</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($incomeTransactions as $transaction){{-- I am buyer --}}
                            @if (!in_array($transaction->type, ['special', 'loan_grant', 'loan_redeem', 'yearly_yield', 'stock_dividend', 'stock_buy', 'stock_sell']))
                                <tr>
                                    <td>{{$transaction->id}}</td>
                                    <td>{{$transaction->sellerResource->resource->name}}</td>
                                    <td>{{$transaction->seller_amount}}</td>
                                    <td>{{$transaction->buyerResource->resource->name}}</td>
                                    <td>{{$transaction->buyer_amount}}</td>
                                    <td>{{$transaction->seller->name}}</td>
                                    <td>{{$transaction->created_at}}</td>
                                    @if($transaction->checked == 0)
                                        @if($transaction->type == 'sell')
                                            <td>
                                                <form action="{{ route('confirmTrans') }}" method="post">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="transactionId"
                                                           value={{$transaction->id}}>
                                                    <button type="submit" name="confirm" value="true"
                                                            class="mdui-btn mdui-btn-icon mdui-color-green mdui-ripple">
                                                        <i class="mdui-icon material-icons">check</i>
                                                    </button>
                                                    &nbsp&nbsp
                                                    <button type='submit' name="confirm" value="false"
                                                            class="mdui-btn mdui-btn-icon mdui-color-red mdui-ripple">
                                                        <i class="mdui-icon material-icons">close</i>
                                                    </button>
                                                </form>
                                            </td>
                                        @else
                                            <td>
                                                等待
                                            </td>
                                        @endif
                                    @elseif($transaction->checked == -1 || $transaction->checked == -2)
                                        <td>
                                            被取消
                                        </td>
                                    @elseif($transaction->checked == 1)
                                        <td>
                                            完成
                                        </td>
                                    @endif
                                    <td>{{$transaction->updated_at}}</td>
                                </tr>
                            @endif
                            @endforeach
                            @foreach($outComeTransactions as $transaction){{-- I am seller --}}
                            @if (!in_array($transaction->type, ['special', 'loan_grant', 'loan_redeem', 'yearly_yield', 'stock_dividend', 'stock_buy', 'stock_sell']))
                                <tr>
                                    <td>{{$transaction->id}}</td>
                                    <td>{{$transaction->buyerResource->resource->name}}</td>
                                    <td>{{$transaction->buyer_amount}}</td>
                                    <td>{{$transaction->sellerResource->resource->name}}</td>
                                    <td>{{$transaction->seller_amount}}</td>
                                    <td>{{$transaction->buyer->name}}</td>
                                    <td>{{$transaction->created_at}}</td>
                                    @if($transaction->checked == 0)
                                        @if($transaction->type == 'buy')
                                            <td>
                                                <form action="{{ route('confirmTrans') }}" method="post">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="transactionId"
                                                           value={{$transaction->id}}>
                                                    <button type="submit" name="confirm" value="true"
                                                            class="mdui-btn mdui-btn-icon mdui-color-green mdui-ripple">
                                                        <i class="mdui-icon material-icons">check</i>
                                                    </button>
                                                    &nbsp&nbsp
                                                    <button type='submit' name="confirm" value="false"
                                                            class="mdui-btn mdui-btn-icon mdui-color-red mdui-ripple">
                                                        <i class="mdui-icon material-icons">close</i>
                                                    </button>
                                                </form>
                                            </td>
                                        @else
                                            <td>
                                                等待
                                            </td>
                                        @endif

                                    @elseif($transaction->checked == -1 || $transaction->checked == -2)
                                        <td>
                                            被取消
                                        </td>
                                    @elseif($transaction->checked == 1)
                                        <td>
                                            完成
                                        </td>
                                    @endif
                                    <td>{{$transaction->updated_at}}</td>
                                </tr>
                            @endif
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
