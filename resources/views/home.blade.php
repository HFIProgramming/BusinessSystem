@extends('layouts.base')

@section('body')
    <div class="mdui-container doc-container">
        <div class="mdui-row">
            <div class="mdui-col-xs-6">
                <div class="mdui-card">
                    <div class="mdui-card-header">
                        <img class="mdui-card-header-avatar" src="img/avg.jpg"/>
                        <div class="mdui-card-header-title">name</div>
                        <div class="mdui-card-header-subtitle">Published At: 1970-01-01</div>
                    </div>
                    <div class="mdui-card-primary">
                        <div class="mdui-card-primary-title">Announcement</div>
                        <div class="mdui-card-primary-subtitle">Recent Nodes Adjustment</div>
                    </div>
                    <div class="mdui-card-content">
                        <div class="mdui-typo-subheading">The following Node will be removed due to low usage</div>
                        <ul class="mdui-list">
                            <li class="mdui-list-item mdui-ripple">Venus</li>
                            <li class="mdui-list-item mdui-ripple">Pluto</li>
                            <li class="mdui-list-item mdui-ripple">Ceres</li>
                        </ul>
                        <div class="mdui-card-actions">
                            <button class="mdui-btn mdui-ripple">Read More</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mdui-col-lg-6">
                <div class="mdui-card">
                    <div class="mdui-card-media">
                        <img src="img/card.jpg"/>
                        <div class="mdui-card-media-covered mdui-card-media-covered-gradient">
                            <div class="mdui-card-primary">
                                <div class="mdui-card-primary">
                                    <div class="mdui-card-primary-title">Summary</div>
                                    <div class="mdui-card-primary-subtitle">Updated at 10 minutes ago</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mdui-card-content">
                        <ul class="mdui-list">
                            <li class="mdui-list-item mdui-ripple">Total Traffic: 10G</li>
                            <li class="mdui-list-item mdui-ripple">Used Traffic: 5G</li>
                            <li class="mdui-list-item mdui-ripple">Left: 5G (50%)</li>
                            <br/>
                            <div class="mdui-progress">
                                <div class="mdui-progress-determinate" style="width: 50%;"></div>
                            </div>
                        </ul>
                    </div>
                    <div class="mdui-card-actions">
                        <button class="mdui-btn mdui-ripple">Detailed Infomation</button>
                        <button class="mdui-btn mdui-ripple">Top Up</button>
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
                                    <li class="mdui-list-item mdui-ripple">Username: <code> Your Email Address</code></li>
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
