@extends('layouts.base')

@section('style')
@endsection

@section('body')

    <div class="mdui-container doc-container">
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
                        @endif
                        <br>
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
                                        @foreach($user->AllTrans->sortByDesc('created_at')->take(1) as $trans)
                                            <li class="mdui-collapse-item mdui-collapse-item-close">
                                                <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
                                                    <i class="mdui-list-item-icon mdui-icon material-icons">send</i>
                                                    <div class="mdui-list-item-content">订单ID: {{$trans->id}}</div>
                                                    <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
                                                </div>
                                                <ul class="mdui-collapse-item-body mdui-list mdui-list-dense">
                                                    <li class="mdui-list-item mdui-ripple">状态:
                                                        <code> {{$trans->status}}</code>
                                                    </li>
                                                    <li class="mdui-list-item mdui-ripple">时间:
                                                        <code> {{$trans->created_at->diffForHumans()}}</code></li>
                                                    <li class="mdui-list-item mdui-ripple">买方: {{$trans->buyer->name}}
                                                        <code>
                                                        </code>
                                                    </li>
                                                    <li class="mdui-list-item mdui-ripple">卖方: {{$trans->seller->name}}
                                                        <code>
                                                        </code>
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--row-->
                    <div class="mdui-col-xs-12  mdui-col-md-6">
                        <div class="mdui-card">
                            <div class="mdui-card-media">
                                <img src="/img/card.jpg"/>
                                <div class="mdui-card-media-covered mdui-card-media-covered-gradient">
                                    <div class="mdui-card-primary">
                                        <div class="mdui-card-primary">
                                            <div class="mdui-card-primary-title">实时情况</div>
                                            <div class="mdui-card-primary-subtitle">
                                                点击左侧栏DashBoard更新数据
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mdui-card-content">
                                <ul class="mdui-list">
                                    <li class="mdui-list-item mdui-ripple">
                                        你的ID：{{$user->id}}</li>
                                    <li class="mdui-list-item mdui-ripple">
                                        你的类型：{{$user->userType}}</li>
                                    <li class="mdui-divider"></li>
                                    <li class="mdui-list-item mdui-ripple">
                                        当前财年：{{$current = \App\Config::KeyValue('current_round')->value}}</li>
                                    <li class="mdui-list-item mdui-ripple">
                                        总财年：{{$total = \App\Config::KeyValue('total_round')->value}}</li>
                                    <div class="mdui-progress">
                                        <div class="mdui-progress-determinate"
                                             style="width: {{$percent = ($current/$total)*100}}%;"></div>
                                    </div>
                                    <li class="mdui-list-item mdui-ripple">
                                        当前比赛：{{\App\Config::KeyValue('is_continued')->value == true ? '正在进行' : '暂停中'}}</li>
                                    @if(\App\Config::KeyValue('is_continued')->value == true)
                                        <div class="mdui-progress">
                                            <div class="mdui-progress-indeterminate"></div>
                                        </div>
                                    @else
                                        <div class="mdui-progress">
                                            <div class="mdui-progress-determinate" style="width: {{$percent}}%;"></div>
                                        </div>
                                    @endif
                                    <br>
                                    <li class="mdui-divider"></li>
                                    <li class="mdui-list-item mdui-ripple mdui-typo-headline">物品清单</li>
                                    <br>
                                    @foreach($user->resources()->get() as $resource)
                                        @if($resource->resource->type >=0 && $resource->resource->type <= 3)
                                        <li class="mdui-list-item mdui-ripple">{{$resource->resource->name}}
                                            : {{$resource->amount}}</li>
                                        @endif
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
            </div>
@endsection
