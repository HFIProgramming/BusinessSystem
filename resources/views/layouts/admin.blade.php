<!DOCTYPE html>
<body lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')

    <title>@yield('title'){{ config('app.name', ' NoticeBoard') }}</title>

    <!-- Basic Styles and JS-->
    <link href="//cdn.bootcss.com/mdui/0.2.1/css/mdui.min.css" rel="stylesheet">
    <script src="//cdn.bootcss.com/mdui/0.2.1/js/mdui.min.js"></script>
    <style>
        .doc-container {
            padding-top: 30px;
            padding-bottom: 150px;
        }

        .mdui-card {
            margin: 1% 2%;
        }

        .mdui-card-header {

            text-align: center !important;
            /*margin-left: -52px !important;*/
        }

        .footer {
            margin-top: 25px;
        }
    </style>
    @yield('stylesheet')
    @yield('script')
</head>

<body class="mdui-theme-primary-indigo mdui-theme-accent-red mdui-drawer-body-left mdui-appbar-with-toolbar">

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
            <div class="mdui-list-item-content">公告</div>
        </li>
        <li class="mdui-list-item mdui-ripple">
            <i class="mdui-list-item-icon mdui-icon material-icons">people</i>
            <div class="mdui-list-item-content">用户信息</div>
        </li>
        <li class="mdui-list-item mdui-ripple">
            <i class="mdui-list-item-icon mdui-icon material-icons">list</i>
            <div class="mdui-list-item-content">资源信息</div>
        </li>
        <li class="mdui-list-item mdui-ripple">
            <i class="mdui-list-item-icon mdui-icon material-icons">library_books</i>
            <div class="mdui-list-item-content">日志</div>
        </li>
        <li class="mdui-divider"></li>
        <li class="mdui-list-item mdui-ripple">
            <i class="mdui-list-item-icon mdui-icon material-icons">subdirectory_arrow_left</i>
            <a href="{{route('dashboard')}}" class="mdui-list-item-content">返回选手页面</a>
        </li>
    </ul>
</div>

@yield('body')
<div class="footer mdui-bottom-nav mdui-bottom-nav-text-auto mdui-color-theme">
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
</body>
</html>