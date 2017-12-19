<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CompanyFinancialReport</title>


    <link href="https://cdn.bootcss.com/mdui/0.3.0/css/mdui.min.css" rel="stylesheet">
    <script src="mdui.min.js" data-no-instant></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.js"></script>
    <script src="utils.js"></script>
    <script>

        var html = '';
        var receivedInfo, labels,datasets;

        var randomScalingFactor = function () {
            return Math.round(Math.random() * 100);
        };

        function randomColor() {
            var r = Math.floor(Math.random() * 256);
            var g = Math.floor(Math.random() * 256);
            var b = Math.floor(Math.random() * 256);
            return "rgb(" + r + ',' + g + ',' + b + ")";
        }

//        var receivedInfo = [{
//                "id": 001,
//                "cur_price": 10,
//                "all_prices": [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()],
//                "company_name": "test1",
//                "total": 500,
//                "dividend": 20,
//                "hand_up": 0,
//                "sell_remain": 5,
//                "buy_remain": 10
//            }, {
//                "id": 002,
//                "cur_price": 100,
//                "all_prices": [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()],
//                "company_name": "test2",
//                "total": 5000,
//                "dividend": 200,
//                "hand_up": 20,
//                "sell_remain": 50,
//                "buy_remain": 100
//            }]
//        ;

        function information() {
            $.ajax({
                url: "{{route('stockData')}}",
                dataType: "json",
                type: "GET",
                success: function(msg) {
                    receivedInfo = msg;
                    for (var i=0;i<msg.length;i++) {
                        datasets[i]["lineTension: "] = 0;
                        datasets[i]["label"] = msg[i]["company_name"];
                        var color = randomColor();
                        datasets[i]["borderColor"] = color;
                        datasets[i]["backgroundColor"] = color;
                        datasets[i]["fill"] = false;
                        datasets[i]["data"] = msg[i]["all_prices"];
                        datasets[i]["yAxisID"] = "y-axis";
                        labels.push("");
                    }
                },
                error: function() {
                   alert("qubudaoDBQ");
                }
            })
        }



//下面这个反正放进去就不能用了估计是没引入（？）之类的问题
//        html += '</div> </div> </td> <td> <form action="{{ route('buyStock') }}" method="post"> {{ csrf_field() }}';
//        html += '<td> <form action="{{ route('sellStock') }}" method="post">{{ csrf_field() }}';

        function createDom() {
                    $.each(receivedInfo, function() {
                    html += '<tr> <td class="mdui-panel " mdui-panel> <div class="mdui-panel-item"> <div class="mdui-panel-item-header"> <div class="mdui-panel-item-title">';
                    html += this.company_name + '</div>';
                    html += '<div class="mdui-panel-item-summary">Current Price: ' + this.cur_price + '</div>';
                    html += '<div class="mdui-panel-item-summary">Now you have: ' + this.hand_up + '</div>';
                    html += '<i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i> </div>';
                    html += '<div class="mdui-panel-item-body"> <p>total: ' + this.total + '</p>';
                    html += '<p>dividend: ' + this.dividend + '</p>';
                    html += '<p>sell remain: ' + this.sell_remain + '</p>';
                    html += '<p>buy remain: ' + this.buy_remain + '</p>';
                    html += '</div> </div> </td> <td> <form>';
                    html += '<input type="hidden" name=' + this.id + '>';
                    html += '<div class="mdui-textfield"> <input class="mdui-textfield-input" type="text" name="amount" placeholder="$"> </div> <button type="submit" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent">Buy </button> </form> </td>';
                    html += '<td> <form>';
                    html += '<input type="hidden" name=' + this.id + '>';
                    html += '<div class="mdui-textfield"> <input class="mdui-textfield-input" type="text" name="amount"> </div> <button type="submit" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent">Sell </button> </form> </td> </tr>';
                    });
        };
//

        $(document).ready(function () {
//                    setTimeout(information(),5000);
            createDom();
            $('#table').html(html);
            $('i').click(function () {
//                alert($(this).parents(".mdui-panel-item").hasClass("mdui-panel-item-open"));
                if ($(this).parents(".mdui-panel-item").hasClass("mdui-panel-item-open") === false) {
                    $(this).parents(".mdui-panel-item").addClass("mdui-panel-item-open");
                } else {
                    $(this).parents(".mdui-panel-item").removeClass("mdui-panel-item-open");
                }
            });
//            $(html).insertAfter("#table");
//            document.getElementById("table").innerHTML = html;
        });


//        var datasets = [{
//            lineTension: 0,
//            label: "My First dataset",
//            borderColor: window.chartColors.red,
//            backgroundColor: window.chartColors.red,
//            fill: false,
//            data: data1,
//            yAxisID: "y-axis",
//        }, {
//            lineTension: 0,
//            label: "My Second dataset",
//            borderColor: window.chartColors.blue,
//            backgroundColor: window.chartColors.blue,
//            fill: false,
//            data: data2,
//            yAxisID: "y-axis"
//        }, {
//            lineTension: 0,
//            label: "My Third dataset",
//            borderColor: window.chartColors.blue,
//            backgroundColor: window.chartColors.blue,
//            fill: false,
//            data: data3,
//            yAxisID: "y-axis"
//        }];

        var lineChartData = {
            labels: labels,
            datasets: datasets
        };

        window.onload = function () {
            var ctx = document.getElementById("stock").getContext("2d");
            window.myLine = Chart.Line(ctx, {
                data: lineChartData,
                options: {
                    responsive: true,
                    hoverMode: 'index',
                    stacked: false,
                    title: {
                        display: false,
                        text: 'Chart.js Line Chart - Multi Axis'
                    },
                    scales: {
                        yAxes: [{
                            type: "linear", // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                            display: true,
                            position: "left",
                            id: "y-axis",
                            // grid line settings
                            gridLines: {
                                drawOnChartArea: true, // only want the grid lines for one axis to show up
                            },
                        }],
                    }
                }
            });
        };

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


    </style>
</head>


<body class="mdui-theme-primary-indigo mdui-drawer-body-left mdui-appbar-with-toolbar">


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
            <div class="mdui-list-item-content">DashBoard</div>
        </li>
        <li class="mdui-list-item mdui-ripple">
            <i class="mdui-list-item-icon mdui-icon material-icons">view_list</i>
            <div class="mdui-list-item-content">List Transaction</div>
        </li>
        <li class="mdui-list-item mdui-ripple">
            <i class="mdui-list-item-icon mdui-icon material-icons">format_list_numbered</i>
            <div class="mdui-list-item-content">List Resource</div>
        </li>
        <li class="mdui-list-item mdui-ripple">
            <i class="mdui-list-item-icon mdui-icon material-icons">attach_money</i>
            <div class="mdui-list-item-content">Purchase</div>
        </li>
        <li class="mdui-list-item mdui-ripple">
            <i class="mdui-list-item-icon mdui-icon material-icons">people_outline</i>
            <div class="mdui-list-item-content">New Transaction</div>
        </li>
        <li class="mdui-divider"></li>
        <li class="mdui-list-item mdui-ripple">
            <i class="mdui-list-item-icon mdui-icon material-icons">developer_board</i>
            <div class="mdui-list-item-content">Admin Config</div>
        </li>
        <li class="mdui-list-item mdui-ripple">
            <i class="mdui-list-item-icon mdui-icon material-icons">subdirectory_arrow_left</i>
            <div class="mdui-list-item-content">Log Out</div>
        </li>
    </ul>
</div>

<div class="mdui-container doc-container">
    <div class="mdui-card-header">
        <div class="mdui-typo-display-1 mdui-text-center mdui-text-color-theme">
            Stock Information and Transaction
        </div>
    </div>
    <div class="mdui-col-md-12">
        <div class="mdui-card mdui-col-md-12">
            <canvas id="stock"></canvas>
        </div>

        <div class="mdui-card mdui-table-fluid">
            <table class="mdui-table mdui-table-hoverable">
                <thead >
                <tr>
                    <th>Name</th>
                    <th>Buy</th>
                    <th>Sell</th>
                </tr>
                </thead>
                <tbody id="table">
                <tr>
                    <td class="mdui-panel" mdui-panel>
                        <div class="mdui-panel-item ">
                            <div class="mdui-panel-item-header">
                                <div class="mdui-panel-item-title">Stock</div>
                                <div class="mdui-panel-item-summary">Start date: Feb 29, 2016</div>
                                <div class="mdui-panel-item-summary">End date: Not set</div>
                                <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
                            </div>
                            <div class="mdui-panel-item-body">
                                <p>对不起啦人家就是想把信息放下拉</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <form action="{{ route('buyStock') }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name=>
                            <div class="mdui-textfield">
                                <input class="mdui-textfield-input" type="text" name="amount">
                            </div>
                            <button type="submit" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent">
                                Buy
                            </button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('sellStock') }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name=>
                            <div class="mdui-textfield">
                                <input class="mdui-textfield-input" type="text" name="amount">
                            </div>
                            <button type="submit" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent">
                                Sell
                            </button>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td class="mdui-panel" mdui-panel>
                        <div class="mdui-panel-item">
                            <div class="mdui-panel-item-header">
                                <div class="mdui-panel-item-title">Stock</div>
                                <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
                            </div>
                            <div class="mdui-panel-item-body">
                                <ul>
                                    <li>
                                        test1
                                    </li>
                                    <li>
                                        tes2
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="mdui-textfield">
                            <input class="mdui-textfield-input" type="text" placeholder="$"/>
                        </div>
                        <button class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent">Buy</button>
                    </td>
                    <td>
                        <div class="mdui-textfield">
                            <input class="mdui-textfield-input" type="text" placeholder="$"/>
                        </div>
                        <button class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent">Buy</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>

</div>
<div class="mdui-bottom-nav mdui-bottom-nav-text-auto mdui-color-indigo">
    <div class="mdui-container">
        <div class="mdui-row">
            <div class="mdui-row-lg-6">
            </div>
        </div>
    </div>
</div>

</body>
</html>