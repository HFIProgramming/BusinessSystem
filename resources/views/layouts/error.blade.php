<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')

    <title>@yield('title'){{ config('app.name', '- By HFIProgramming') }}</title>

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

<body class="mdui-theme-primary-{{\App\Config::KeyValue('primary_color')->value}} mdui-theme-accent-{{\App\Config::KeyValue('accent_color')->value}} mdui-appbar-with-toolbar">


<div class="mdui-appbar mdui-appbar-fixed">
    <div class="mdui-toolbar mdui-color-theme">
        <a class="mdui-btn mdui-btn-icon" mdui-drawer="{target: '#left-drawer'}"><i class="mdui-icon material-icons">menu</i></a>
        <a href="javascript:;" class="mdui-typo-title">Finance Club</a>
    </div>
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
<script src="https://cdn.bootcss.com/mdui/0.3.0/js/mdui.min.js"></script>
</body>
</html>