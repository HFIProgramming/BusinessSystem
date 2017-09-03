<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')

    <title>@yield('title'){{ config('app.name', ' HFIProgramming') }}</title>

    <!-- Basic Styles and JS-->
    <link href="https://cdn.bootcss.com/mdui/0.3.0/css/mdui.min.css" rel="stylesheet">
    <style>
        .doc-container {
            padding-top: 30px;
            padding-bottom: 150px;
        }

        .footer {
            margin-top: 25px;
        }

        .footer_bar {
            margin-top: 100px;
        }

        .adjust_card_subtitle {
            margin-left: 0;
        }

        .adjust_card {
            padding-top: 30px;
            padding-bottom: 130px;
        }

        .adjust_mdui_icon {
            bottom: 33px !important;
        }
    </style>
    @yield('stylesheet')
    @yield('script')
</head>

<body class="mdui-theme-primary-{{\App\Config::KeyValue('primary_color')->value}} mdui-theme-accent-{{\App\Config::KeyValue('accent_color')->value}} mdui-drawer-body-left mdui-appbar-with-toolbar">


<div class="mdui-appbar mdui-appbar-fixed">
    <div class="mdui-toolbar mdui-color-theme">
        <a class="mdui-btn mdui-btn-icon" mdui-drawer="{target: '#left-drawer'}"><i class="mdui-icon material-icons">menu</i></a>
        <a href="javascript:;" class="mdui-typo-title">Finance Club</a>
    </div>
</div>

<div class="mdui-drawer mdui-drawer-open" id="left-drawer">
    <ul class="mdui-list">
        <li class="mdui-list-item mdui-ripple">
            <i class="mdui-list-item-icon mdui-icon material-icons">dashboard</i>
            <a href="{{route('dashboard')}}" class="mdui-list-item-content">DashBoard</a>
        </li>
        <li class="mdui-list-item mdui-ripple">
            <i class="mdui-list-item-icon mdui-icon material-icons">view_list</i>
            <a href="{{route('TransactionList')}}" class="mdui-list-item-content">List Transaction</a>
        </li>
        <li class="mdui-list-item mdui-ripple">
            <i class="mdui-list-item-icon mdui-icon material-icons">format_list_numbered</i>
            <a href="{{route('resource')}}" class="mdui-list-item-content">List Resource</a>
        </li>
        <li class="mdui-list-item mdui-ripple">
            <i class="mdui-list-item-icon mdui-icon material-icons">attach_money</i>
            <a href="{{route('purchaseForm')}}" class="mdui-list-item-content">Purchase</a>
        </li>
        <li class="mdui-list-item mdui-ripple">
            <i class="mdui-list-item-icon mdui-icon material-icons">people_outline</i>
            <a href="{{route('TransLanding')}}" class="mdui-list-item-content">New Transaction</a>
        </li>
        <li class="mdui-divider"></li>
        @if(auth()->id() == 1)
            <li class="mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons">developer_board</i>
                <a href="{{route('adminDashboard')}}" data-no-instant class="mdui-list-item-content">Admin Config</a>
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
<script src="https://cdn.bootcss.com/mdui/0.3.0/js/mdui.min.js" data-no-instant></script>
<script data-no-instant>
    var $$ = mdui.JQ;
    InstantClick.on('wait', function () {
        $$.showOverlay(5000);
    });
    InstantClick.on('change', function () {
        var s = document.createElement('script');
        s.src = 'https://cdn.bootcss.com/mdui/0.3.0/js/mdui.min.js';
        document.body.appendChild(s);
        $$.hideOverlay(true);
    });
    InstantClick.init();
</script>
</body>
</html>