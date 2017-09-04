@extends('layouts.base')

@section('style')
@endsection

@section('body')

    <div class="mdui-container doc-container">
        <div class="mdui-row">
            @if (!empty($announcement))
                <div class="mdui-col-xs-12 mdui-col-md-6">
                    <div class="mdui-card">
                        <div class="mdui-card-header">
                            <img class="mdui-card-header-avatar" src="/img/avg.jpg"/>
                            <div class="mdui-card-header-title">Author: Admin</div>
                            <div class="mdui-card-header-subtitle">Published At: {{$announcement->timestamp}}</div>
                        </div>
                        <div class="mdui-card-primary">
                            <div class="mdui-card-primary-title">{{$announcement->title}}</div>
                            <div class="mdui-card-primary-subtitle">Recent Adjustment</div>
                        </div>
                        <div class="mdui-card-content">
                            <div class="mdui-typo-subheading">Please Always keep notifying</div>
                            {{$announcement->content}}
                            <div class="mdui-card-actions">
                                <button class="mdui-btn mdui-ripple"
                                        onclick="window.location.href='{{route('announcement')}}'">Read More
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="mdui-col-xs-12 mdui-col-md-6">
                    <div class="mdui-card">
                        <div class="mdui-card-header">
                            <img class="mdui-card-header-avatar" src="/img/avg.jpg"/>
                            <div class="mdui-card-header-title">Author: Admin</div>
                            <div class="mdui-card-header-subtitle">Oops!</div>
                        </div>
                        <div class="mdui-card-primary">
                            <div class="mdui-card-primary-title">No Announcement !</div>
                            <div class="mdui-card-primary-subtitle">QvQ</div>
                        </div>
                        <div class="mdui-card-content">
                            <div class="mdui-typo-subheading">Please Always keep notifying</div>
                            现在还没有公告呢……一定是他们太懒了
                            <div class="mdui-card-actions">
                                <button class="mdui-btn mdui-ripple"
                                        onclick="window.location.href='{{route('announcement')}}'">Read More
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="mdui-col-xs-12 mdui-col-md-6">
                <div class="mdui-card">
                    <div class="mdui-card-media">
                        <img src="/img/card.jpg"/>
                        <div class="mdui-card-media-covered mdui-card-media-covered-gradient">
                            <div class="mdui-card-primary">
                                <div class="mdui-card-primary">
                                    <div class="mdui-card-primary-title">实时情况</div>
                                    <div class="mdui-card-primary-subtitle">
                                        <a class="mdui-list-item-content" href="{{ route('dashboard') }}">点击更新数据</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mdui-card-content">
                        <ul class="mdui-list">
                            <li class="mdui-list-item mdui-ripple">
                                当前财年：{{$current = \App\Config::KeyValue('current_round')->value}}</li>
                            <li class="mdui-list-item mdui-ripple">
                                总财年：{{$total = \App\Config::KeyValue('total_round')->value}}</li>
                            <div class="mdui-progress">
                                <div class="mdui-progress-determinate"
                                     style="width: {{$current/$total}}%;"></div>
                            </div>
                            <li class="mdui-divider"></li>
                            @foreach($user->resources()->get() as $resource)
                                <li class="mdui-list-item mdui-ripple">{{ucfirst($resource->resource()->value('name'))}}
                                    : {{$resource->amount}}</li>
                            @endforeach
                            <br/>
                        </ul>
                    </div>
                    <div class="mdui-card-actions">
                        <button class="mdui-btn mdui-ripple"
                                onclick="window.location.href='{{route('purchaseForm')}}'">Top Up
                        </button>
                    </div>
                    <br/>
                </div>
            </div>
            <!--row-->
        </div>
        <div class="mdui-row">
            <div class="mdui-col-xs-12  mdui-col-md-6">
                <div class="mdui-card">
                    <div class="mdui-card-primary">
                        <div class="mdui-card-primary-title">Latest Transaction</div>
                        <div class="mdui-card-primary-subtitle">Take good care of it !</div>
                    </div>
                    <div class="mdui-card-content">
                        <ul class="mdui-list" mdui-collapse="{accordion: true}">
                            @if ($user->AllTrans->isempty())
                                <li class="mdui-collapse-item mdui-collapse-item">
                                    <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
                                        <i class="mdui-list-item-icon mdui-icon material-icons">send</i>
                                        <div class="mdui-list-item-content">什么都没有诶……</div>
                                        <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
                                    </div>
                                    <ul class="mdui-collapse-item-body mdui-list mdui-list-dense">
                                        <li class="mdui-list-item mdui-ripple">快去创建你的第一个订单吧</li>
                                    </ul>
                                </li>
                            @else
                                @foreach($user->AllTrans->sortByDesc('created_at') as $trans)
                                    <li class="mdui-collapse-item mdui-collapse-item-close">
                                        <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
                                            <i class="mdui-list-item-icon mdui-icon material-icons">send</i>
                                            <div class="mdui-list-item-content">ID: {{$trans->id}}</div>
                                            <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
                                        </div>
                                        <ul class="mdui-collapse-item-body mdui-list mdui-list-dense">
                                            <li class="mdui-list-item mdui-ripple">Port: <code> 10800</code></li>
                                            <li class="mdui-list-item mdui-ripple">Password: <code> Secret</code></li>
                                            <li class="mdui-list-item mdui-ripple">Method: <code> aes-256-cfb</code>
                                            </li>
                                        </ul>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                        <br/>
                        <div class="mdui-card-actions">
                            <button onclick="window.location.href='{{route('TransactionList')}}'"
                                    class="mdui-btn mdui-ripple">Transaction List
                            </button>
                            <button onclick="window.location.href='#'"
                                    class="mdui-btn mdui-ripple">New Transaction
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
