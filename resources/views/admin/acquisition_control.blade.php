@extends('layouts.admin')

@section('body')
    <div class="mdui-container doc-container">
        <div class="mdui-row">
            <div class="mdui-col-xs-12">
                <div class="mdui-card-header">
                    <div class="mdui-typo-display-2 mdui-text-center mdui-text-color-theme">
                        控制收购状态
                    </div>
                </div>


                <div class="mdui-card-content mdui-typo">

                    <h3 class="mdui-text-center">
                        现在是第{{$year}}财年

                        @if($status == 1)
                            目前正在收购
                        @endif
                        @if($status == 0)
                            目前不在收购哦
                        @endif


                        <div class="mdui-text-center">
                            <br><br>
                            <form method="post" action="{{ route('setAcquisitionStatus') }}">
                                {{ csrf_field() }}
                                <button type="submit" name="status" value="1"
                                        class="mdui-btn mdui-btn-raised mdui-color-theme-accent mdui-ripple ">
                                    <i class="mdui-icon material-icons">keyboard_arrow_right</i>
                                    开始
                                </button>
                                <button type="submit" name="status" value="0"
                                        class="mdui-btn mdui-btn-raised mdui-color-theme-accent mdui-ripple ">
                                    <i class="mdui-icon material-icons">keyboard_arrow_right</i>
                                    结束
                                </button>
                            </form>
                        </div>

                        <br>
                        <a href="{{route('doAuctionTransactions')}}"
                           class="mdui-btn mdui-btn-raised mdui-color-theme-accent mdui-ripple">
                            <i class="mdui-icon material-icons">exit_to_app</i>
                            清算
                        </a>
                        <br><br>
                    </h3>
                </div>

                <div class="mdui-text-center mdui-typo-display-1">
                    收购状态
                </div>

                <br><br>
                <form method="post" enctype="application/json" action="{{ route('setAcquisitionAmount') }}">
                    <div class="mdui-table-fluid">
                        <table class="mdui-table">
                            <thead>
                            <tr>
                                <th>item</th>
                                <th>amount</th>
                            </tr>
                            </thead>
                            <tbody>

                            {{ csrf_field() }}
                            @foreach($acquisition_items_and_amount as $item_id => $amount)
                                <tr>
                                    <td>{{$item_id}}</td>
                                    <td>
                                        <div class="mdui-textfield mdui-textfield-floating-label">
                                            <label class="mdui-textfield-label">amount</label>
                                            <input class="mdui-textfield-input"
                                                   name="acquisition_items_and_amount[{{ $item_id }}]" type="number"
                                                   value="{{ $amount }}"/>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <button data-no-instant
                                class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme mdui-center">
                            提交
                        </button>
                        <br>
                    </div>
                    <br>
                </form>
                <br>
                <div class="mdui-text-center mdui-typo-display-1">
                    投标列表
                </div>

                <br><br>
                <div class="mdui-table-fluid">
                    <table class="mdui-table">
                        <thead>
                        <tr>
                            <th>财年</th>
                            <th>资源</th>
                            <th>数量</th>
                            <th>单价</th>
                            <th>状态</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bids as $bid)
                            <tr>
                                <td>{{$bid->year}}</td>
                                <td>{{App\Resources::find($bid->resource_id)->name}}</td>
                                <td>{{$bid->amount}}</td>
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

@endsection