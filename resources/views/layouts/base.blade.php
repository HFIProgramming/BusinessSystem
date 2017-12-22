<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')

    <title>@yield('title'){{ config('app.name', ' - HFIProgramming') }}</title>

    <!-- Basic Styles and JS-->
    <link href="https://cdn.bootcss.com/mdui/0.3.0/css/mdui.min.css" rel="stylesheet">
    <script src="https://cdn.bootcss.com/mdui/0.3.0/js/mdui.min.js" data-no-instant></script>
    <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            var tTop = parseFloat($("#gfcImage").css("height")) + parseFloat($(".mdui-appbar").css("height")) - parseFloat($("img").css("height")) * 0.3 / 2 + "px";
            var tLeft = (parseFloat($("#gfcImage").css("width")) / 2) - (parseFloat($("img").css("width")) * 0.3 / 2) + "px";
            var width = parseFloat($("#gfcImage").css("width")) * 0.3 + "px";
            var height = parseFloat($("#gfcImage").css("height")) * 0.3 + "px";
            var blockHeight = parseFloat($("#gfcImage").css("height")) * 0.3 / 2 + "px";
            // alert($("#nav").css("width"));

            $('#title').css({
                "position": "absolute",
                "width": width,
                "height": height,
                "top": tTop,
                "left": tLeft,
                "background-color": "#389688"
            });
            $('#title').addClass('mdui-valign');
            $('#title').addClass('mdui-shadow-12');

            $('#block').css({
                "height": blockHeight
            });


            $('.navButton').hover(
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

        .title {
            height: 1000px;
            width: 5000px;
            background-color: black;
        }
    </style>
    @yield('stylesheet')
    @yield('script')
</head>

<body class="mdui-theme-primary-{{\App\Config::KeyValue('primary_color')->value}} mdui-theme-accent-{{\App\Config::KeyValue('accent_color')->value}} mdui-appbar-with-toolbar">

<div id="nav" class="mdui-appbar mdui-appbar-fixed">
    <div class="mdui-toolbar mdui-color-white mdui-row">
        <!--<a class="mdui-btn mdui-btn-icon" mdui-drawer="{target: '#left-drawer'}"><i class="mdui-icon material-icons">menu</i></a>-->
        <div class="mdui-col-md-1"></div>
        <a href="{{route('dashboard')}}" class="mdui-typo-title">Finance Club</a>
        <button class="navButton mdui-btn mdui-color-theme-accent" style="width: 150px !important;height: 100% !important;" mdui-menu="{target: '#first'}">信息
        </button>
        <div></div>
        <button class="navButton mdui-btn mdui-color-theme-accent" style="width: 150px !important;height: 100% !important;" mdui-menu="{target: '#second'}">贷款
        </button>
        <div></div>
        <button class="navButton mdui-btn mdui-color-theme-accent" style="width: 150px !important;height: 100% !important;" mdui-menu="{target: '#third'}">资源
        </button>
        <div></div>
        <button class="navButton mdui-btn mdui-color-theme-accent" style="width: 150px !important;height: 100% !important;" mdui-menu="{target: '#fourth'}">交易
        </button>
        <div id="effect"></div>
        <ul class="mdui-menu mdui-menu-cascade" id="first">
            <li class="mdui-menu-item">
                <a href="{{route('companyReports')}} class="mdui-ripple">
                    公司报表
                </a>
            </li>
            <li class="mdui-menu-item">
                <a href="{{route('bankReports')}} class="mdui-ripple">
                投行报表
                </a>
            </li>
            <li class="mdui-menu-item">
                <a href="{{route('zones')}} class="mdui-ripple">
                地块
                </a>
            </li>
            <li class="mdui-menu-item">
                <a href="{{route('viewStocks')}} class="mdui-ripple">
                股票
                </a>
            </li>
        </ul>


        <ul class="mdui-menu mdui-menu-cascade" id="second">
            <li class="mdui-menu-item">
                <a href="{{route('loanForm')}} class="mdui-ripple">
                放贷
                </a>
            </li>
            <li class="mdui-menu-item">
                <a href="{{route('listLoans')}} class="mdui-ripple">
                贷款列表
                </a>
            </li>
        </ul>

        <ul class="mdui-menu mdui-menu-cascade" id="third">
            <li class="mdui-menu-item">
                <a href="{{route('resource')}} class="mdui-ripple">
                资源列表
                </a>
            </li>
            <li class="mdui-menu-item">
                <a href="{{route('buildForm')}} class="mdui-ripple">
                建筑
                </a>
            </li>
        </ul>

        <ul class="mdui-menu mdui-menu-cascade" id="fourth">
            <li class="mdui-menu-item">
                <a href="{{route('TransactionList')}} class="mdui-ripple">
                交易列表
                </a>
            </li>
            <li class="mdui-menu-item">
                <a href="{{route('BuyGov')}} class="mdui-ripple">
                从政府买入
                </a>
            </li>
            <li class="mdui-menu-item">
                <a href="{{route('SellGov')}} class="mdui-ripple">
                向政府卖出
                </a>
            </li>
            <li class="mdui-menu-item">
                <a href="{{route('TransIn')}} class="mdui-ripple">
                买
                </a>
            </li>
            <li class="mdui-menu-item">
                <a href="{{route('TransOut')}} class="mdui-ripple">
                卖
                </a>
            </li>
        </ul>
    </div>
</div>

<img id="gfcImage" src="img/background.png" style="width: 100%;">
<div id="title">
    <div class="mdui-center mdui-typo-display-1 mdui-text-center mdui-text-color-white">
        @yield('title')
    </div>
</div>


<div id="block"></div>


                {{--<li class="mdui-list-item mdui-ripple">--}}
                {{--<i class="mdui-list-item-icon mdui-icon material-icons">attach_money</i>--}}
                {{--<a href="{{route('purchaseForm')}}" class="mdui-list-item-content">Purchase</a>--}}
                {{--</li>--}}



                {{--<div class="mdui-collapse-item-header mdui-list-item mdui-ripple">--}}
                {{--<i class="mdui-list-item-icon mdui-icon material-icons">people_outline</i>--}}
                {{--<div class="mdui-list-item-content">Government Related</div>--}}
                {{--<i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>--}}
                {{--</div>--}}
                {{--<ul class="mdui-collapse-item-body mdui-list mdui-list-dense">--}}
                {{--<li class="mdui-list-item mdui-ripple">--}}
                {{--<a href="{{route('BuyGov')}}" class="mdui-list-item-content">Buy From Government</a>--}}
                {{--</li>--}}
                {{--<li class="mdui-list-item mdui-ripple">--}}
                {{--<a href="{{route('SellGov')}}" class="mdui-list-item-content">Sell To Government</a>--}}
                {{--</li>--}}
                {{--</ul>--}}
                {{--</li>--}}
                {{--@if (Auth::user()->type == 1)--}}
                {{--<li class="mdui-list-item mdui-ripple">--}}
                {{--<i class="mdui-list-item-icon mdui-icon material-icons">attach_money</i>--}}
                {{--<a href="{{route('BuyGov')}}" class="mdui-list-item-content">Buy From Government</a>--}}
                {{--</li>--}}
                {{--@elseif (Auth::user()->type == 2)--}}
                {{--<li class="mdui-list-item mdui-ripple">--}}
                {{--<i class="mdui-list-item-icon mdui-icon material-icons">attach_money</i>--}}
                {{--<a href="{{route('SellGov')}}" class="mdui-list-item-content">Sell To Government</a>--}}
                {{--</li>--}}
                {{--@endif--}}
                @if (Auth::user()->type == 2)
                    <li class="mdui-list-item mdui-ripple">
                        <i class="mdui-list-item-icon mdui-icon material-icons">navigation</i>
                        <a href="{{route('showTech')}}" class="mdui-list-item-content">Technology</a>
                    </li>
                @endif
                <li class="mdui-list-item mdui-ripple">
                    <i class="mdui-list-item-icon mdui-icon material-icons">list</i>
                    <a href="{{route('announcement')}}" class="mdui-list-item-content">Announcement</a>
                </li>
                <li class="mdui-divider"></li>
                @if(auth()->id() == 1)
                    <li class="mdui-list-item mdui-ripple">
                        <i class="mdui-list-item-icon mdui-icon material-icons">developer_board</i>
                        <a href="{{route('adminDashboard')}}" data-no-instant class="mdui-list-item-content">Admin
                            Config</a>
                    </li>
                @endif
                <li class="mdui-list-item mdui-ripple">
                    <i class="mdui-list-item-icon mdui-icon material-icons">subdirectory_arrow_left</i>
                    <a href="{{route('logout')}}" data-no-instant class="mdui-list-item-content">Log Out</a>
                </li>
            </ul>
        </div>



        @yield('body')
        <div class="footer_bar mdui-bottom-nav mdui-bottom-nav-text-auto mdui-color-theme">
            <div class="mdui-container">
                <div class="mdui-row">
                    <div class="mdui-row-lg-6">
                        <div class="footer mdui-typo-caption-opacity mdui-text-center">
                            Designed By HFIProgramming Club，编程社出品
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="//cdn.bootcss.com/instantclick/3.0.1/instantclick.min.js" data-no-instant></script>
        <script data-no-instant>
            var $$ = mdui.JQ;
            InstantClick.on('wait', function () {
                $$.showOverlay(5000);
            });
            InstantClick.on('fetch', function () {
                console.log('Page Pre-loading!');
            });
            InstantClick.on('change', function () {
                console.log('Page Loaded!' + location.pathname + location.search);
                var s = document.createElement('script');
                s.src = 'https://cdn.bootcss.com/mdui/0.3.0/js/mdui.min.js';
                document.body.appendChild(s);
                var $$ = mdui.JQ;
                $$.hideOverlay(true);
                // if (document.body.scrollWidth < 1025) {
                //     var inst = new mdui.Drawer('#left-drawer');
                //     inst.close();
                // }
            });
            InstantClick.init();
            <!--I know it is dirty :> But please-->
        </script>
</body>
</html>