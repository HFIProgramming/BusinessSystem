<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')-GambleForCrisis</title>

    <!-- Scripts -->
    <link href="https://cdn.bootcss.com/mdui/0.3.0/css/mdui.min.css" rel="stylesheet">
    <link href="{{ secure_asset('assets/mdi/css/materialdesignicons.min.css') }}" media="all" rel="stylesheet"
          type="text/css"/>
    <script src="https://cdn.bootcss.com/mdui/0.3.0/js/mdui.min.js" data-no-instant></script>
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script href="utils.js"></script>

    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script>
        $(document).ready(function () {
            $('.navi').hover(
                function () {
                    var bLeft = $(this).position().left;
                    bLeft -= 8;
                    $('#effect').css({
                        "position": "absolute",
                        "top": "100%",
                        "left": bLeft,
                        "background-color": "#389688",
                        "width": "150px",
                        "height": "10%"
                    })
                    $(this).addClass('mdui-shadow-5')
                },
                function () {
                    $('#effect').css({
                        "background-color": "transparent"
                    })
                    $(this).removeClass('mdui-shadow-5')
                }
            )
        })
    </script>

    <style>
        .doc-container {
            padding-top: 30px;
            padding-bottom: 150px;
        }

        .mdui-tab {
            min-width: 40px;
        !important;
        }

        .company {
            padding: 10px;
        !important;
        }

        .bg-img {
            height: 700px;
        }

        .mdui-typo-title {
            margin-left: 30px;
        }

        .mdui-color-theme-accent {
            font-size: 15px;
        }
    </style>

    @yield('stylesheet')
    @yield('script')

</head>

<body class="mdui-theme-primary-{{\App\Config::KeyValue('primary_color')->value}}  mdui-drawer-body-left mdui-appbar-with-toolbar">
<div id="app">


    <div class="mdui-appbar mdui-appbar-fixed">
        <div class="mdui-toolbar mdui-color-white mdui-row">
            <a class="mdui-btn mdui-btn-icon" onclick="inst.toggle()"><i class="mdui-icon material-icons">menu</i></a>
            <a href="{{route('dashboard')}}" class="mdui-typo-title">Gamble For Crisis</a>
        </div>
    </div>


    <div class="mdui-drawer mdui-drawer-open" id="left-drawer">
        <ul class="mdui-list" mdui-collapse="{accordion: true}">
            <li class="mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons">dashboard</i>
                <a href="{{route('dashboard')}}" class="mdui-list-item-content">主面板</a>
            </li>
            <li class="mdui-collapse-item">
                <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
                    <i class="mdui-list-item-icon mdui-icon material-icons">people_outline</i>
                    <div class="mdui-list-item-content">交易</div>
                    <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
                </div>
                <ul class="mdui-collapse-item-body mdui-list mdui-list-dense">
                    <li class="mdui-list-item mdui-ripple">
                        <a a class="mdui-list-item-content" href="{{route('TransactionList')}}">交易列表</a>
                    </li>
                    @if(Auth::user()->type != 2)
                        <li class="mdui-list-item mdui-ripple">
                            <a class="mdui-list-item-content" href="{{ route('TransOut') }}">新交易 - 卖家</a>
                        </li>
                        <li class="mdui-list-item mdui-ripple">
                            <a class="mdui-list-item-content" href="{{ route('TransIn') }}">新交易 - 买家</a>
                        </li>
                    @endif
                </ul>
            </li>

            <li class="mdui-collapse-item">
                <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
                    <i class="mdui-list-item-icon mdui-icon material-icons">attach_money</i>
                    <div class="mdui-list-item-content">贷款</div>
                    <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
                </div>
                <ul class="mdui-collapse-item-body mdui-list mdui-list-dense">
                    <li class="mdui-list-item mdui-ripple">
                        <a a class="mdui-list-item-content" href="{{route('listLoans')}}">贷款列表</a>
                    </li>
                    <li class="mdui-list-item mdui-ripple">
                        <a a class="mdui-list-item-content" href="{{route('loanForm')}}">新贷款</a>
                    </li>
                </ul>
            </li>

            <li class="mdui-collapse-item">
                <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
                    <i class="mdui-list-item-icon mdui-icon material-icons">child_friendly</i>
                    <div class="mdui-list-item-content">收购</div>
                    <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
                </div>
                <ul class="mdui-collapse-item-body mdui-list mdui-list-dense">
                    <li class="mdui-list-item mdui-ripple">
                        <a a class="mdui-list-item-content" href="{{route('listAcquisitionBids')}}">收购列表</a>
                    </li>
                    <li class="mdui-list-item mdui-ripple">
                        <a a class="mdui-list-item-content" href="{{route('createAcquisitionBid')}}">新收购</a>
                    </li>
                </ul>
            </li>

            <li class="mdui-collapse-item">
                <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
                    <i class="mdui-list-item-icon mdui-icon material-icons">business_center</i>
                    <div class="mdui-list-item-content">拍卖</div>
                    <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
                </div>
                <ul class="mdui-collapse-item-body mdui-list mdui-list-dense">
                    <li class="mdui-list-item mdui-ripple">
                        <a a class="mdui-list-item-content" href="{{route('listAuctionBid')}}">拍卖列表</a>
                    </li>
                    <li class="mdui-list-item mdui-ripple">
                        <a a class="mdui-list-item-content" href="{{route('createAuctionBid')}}">新拍卖</a>
                    </li>
                </ul>
            </li>


            <li class="mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons">format_list_numbered</i>
                <a href="{{route('resource')}}" class="mdui-list-item-content">资源列表</a>
            </li>
            <li class="mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons">navigation</i>
                <a href="{{route('zones')}}" class="mdui-list-item-content">南北指数</a>
            </li>
            <li class="mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons">account_balance_wallet</i>
                <a href="{{route('bills')}}" class="mdui-list-item-content">年终入账</a>
            </li>
            <li class="mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons">autorenew</i>
                <a href="{{route('purchaseForm')}}" class="mdui-list-item-content">制造</a>
            </li>
            <li class="mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons">build</i>
                <a href="{{route('buildForm')}}" class="mdui-list-item-content">建造建筑</a>
            </li>

            <li class="mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons">list</i>
                <a href="{{route('announcement')}}" class="mdui-list-item-content">公告</a>
            </li>
            <li class="mdui-divider"></li>
            @if(Auth::user()->type == 0)
                <li class="mdui-list-item mdui-ripple">
                    <i class="mdui-list-item-icon mdui-icon material-icons">developer_board</i>
                    <a href="{{route('adminDashboard')}}" data-no-instant class="mdui-list-item-content">管理员</a>
                </li>
            @endif
            <li class="mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons">subdirectory_arrow_left</i>
                <a href="{{route('logout')}}" data-no-instant class="mdui-list-item-content">登出</a>
            </li>
        </ul>
    </div>

    <script>var inst = new mdui.Drawer('#left-drawer');</script>

    @yield('body')

    <div class="footer_bar mdui-bottom-nav mdui-bottom-nav-text-auto mdui-color-theme">
        <div class="mdui-container">
            <div class="mdui-row">
                <div class="mdui-row-lg-6">
                    <div class="footer mdui-typo-caption-opacity mdui-text-center">
                        <br>
                        Designed By HFIProgramming Club，编程社出品
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>