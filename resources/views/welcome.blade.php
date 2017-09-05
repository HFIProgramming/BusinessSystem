<!DOCTYPE html>
<html lang="en" style="height: 100%">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome</title>
    <link href="//cdn.bootcss.com/mdui/0.2.1/css/mdui.min.css" rel="stylesheet">
    <!--<script src="//cdn.bootcss.com/mdui/0.2.1/js/mdui.min.js"></script>-->
    <style>
        @import url(https://fonts.lug.ustc.edu.cn/css?family=Cabin:400);

        #navigation {
            background-color: rgba(0, 0, 0, 0.53);
            color: #fefefe;
        }

        #whole {
            background-image: url('https://i.loli.net/2017/09/02/59aa49ced6701.jpg');
            background-size: auto;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }

        #title {
            height: 100%;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.53);
            color: #fefefe;
            text-align: center;
        }

        #GFC {
            font-weight: 300;
            display: inline-block;
            margin: 22% auto 0;
            position: relative;
            font-size: 80px;
            font-family: 'Cinzelbe7a86c1619abb';
        }

    </style>
</head>
<body id="whole" class="mdui-img-fluid mdui-theme-primary-blue mdui-theme-accent-red mdui-appbar-with-toolbar"
      style="height: 100%">
<div id="navigation">
    <div class="mdui-appbar mdui-appbar-fixed">
        <div class="mdui-toolbar ">
            <a href="javascript:;" class="mdui-typo-title mdui-col-xs-10 mdui-col-lg-8">Finance Club</a>
            @guest
                @if(\App\Config::KeyValue('is_able_to_register')->value == true)
                    <div class="mdui-col-xs-1 mdui-col-lg-2">
                        <button onclick="window.location.href='/login'" class="mdui-btn mdui-ripple">Log In</button>
                    </div>
                    <div class="mdui-col-xs-1 mdui-col-lg-2">
                        <button onclick="window.location.href='/register'" class="mdui-btn mdui-ripple">Register
                        </button>
                    </div>
                @else
                    <div class="mdui-col-xs-2 mdui-col-lg-4">
                        <button onclick="window.location.href='/login'" class="mdui-btn mdui-ripple">Log In</button>
                    </div>
                @endif
            @endguest
            @auth
                <div class=" mdui-col-xs-4 mdui-hidden-xs-down">
                    <button onclick="window.location.href='/dashboard'" class="mdui-btn "> {{auth()->user()->name}},
                        Welcome Back!
                    </button>
                </div>
                <div class="mdui-col-xs-4 mdui-hidden-sm-up">
                    <button onclick="window.location.href='/dashboard'" class="mdui-btn ">DashBoard
                    </button>
                </div>
            @endauth
        </div>
    </div>
</div>

<div id="title" class="">
    <h1 id="GFC">Gamble For Crisis</h1>
    <h2>The world is NOT what it Seems...</h2>
    <h3>2017</h3>
    <p>HFI Finance Club x HFI Programming Club</p>
</div>

</body>
</html>