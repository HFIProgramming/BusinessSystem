@extends('layouts.base')

@section('style')
    <style>
    .adjust_card {
    padding-top: 30px;
    padding-bottom: 130px;
    }
    </style>
@endsection

@section('body')

    <div class="mdui-container doc-container">
        <div class="mdui-row">
            <div class="mdui-col-xs-6">
                <div class="mdui-card">
                    <div class="mdui-card-header">
                        <img class="mdui-card-header-avatar" src="img/avg.jpg"/>
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
            <div class="mdui-col-xs-6">
                <div class="mdui-card">
                    <div class="mdui-card-media">
                        <img src="img/card.jpg"/>
                        <div class="mdui-card-media-covered mdui-card-media-covered-gradient">
                            <div class="mdui-card-primary">
                                <div class="mdui-card-primary">
                                    <div class="mdui-card-primary-title">Summary</div>
                                    <div class="mdui-card-primary-subtitle">Updated at 1 minutes ago</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mdui-card-content">
                        <ul class="mdui-list">
                            @foreach($user->resources()->get() as $resource)
                                <li class="mdui-list-item mdui-ripple">{{ucfirst($resource->resource()->value('name'))}}: {{$resource->amount}}</li>
                            @endforeach
                            <br/>
                            <div class="mdui-progress">
                                <div class="mdui-progress-determinate" style="width: 50%;"></div>
                            </div>
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
            <div class="mdui-col-xs-6">
                <div class="mdui-card">
                    <div class="mdui-card-primary">
                        <div class="mdui-card-primary-title">Latest Transaction</div>
                        <div class="mdui-card-primary-subtitle">Take good care of it !</div>
                    </div>
                    <div class="mdui-card-content">
                        <ul class="mdui-list" mdui-collapse="{accordion: true}">
                            <li class="mdui-collapse-item mdui-collapse-item-close">
                                <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
                                    <i class="mdui-list-item-icon mdui-icon material-icons">send</i>
                                    <div class="mdui-list-item-content">Shadowsocks Service</div>
                                    <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
                                </div>
                                <ul class="mdui-collapse-item-body mdui-list mdui-list-dense">
                                    <li class="mdui-list-item mdui-ripple">Port: <code> 10800</code></li>
                                    <li class="mdui-list-item mdui-ripple">Password: <code> Secret</code></li>
                                    <li class="mdui-list-item mdui-ripple">Method: <code> aes-256-cfb</code></li>
                                </ul>
                            </li>
                            <li class="mdui-collapse-item mdui-collapse-item-close">
                                <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
                                    <i class="mdui-list-item-icon mdui-icon material-icons">cast_connected</i>
                                    <div class="mdui-list-item-content">Anyconnect Service</div>
                                    <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
                                </div>
                                <ul class="mdui-collapse-item-body mdui-list mdui-list-dense">
                                    <li class="mdui-list-item mdui-ripple">Username: <code> Your Email Address</code>
                                    </li>
                                    <li class="mdui-list-item mdui-ripple">Password: <code> Secret</code></li>
                                </ul>
                            </li>
                        </ul>
                        <br/>
                        <div class="mdui-card-actions">
                            <button class="mdui-btn mdui-ripple">Node List</button>
                            <button class="mdui-btn mdui-ripple">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
