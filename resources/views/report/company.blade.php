@extends('layouts.base')

@section('title')
    Company Report
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.3/Chart.bundle.js"></script>
    <script>
        var receivedInfo = [{
            company_id: "1",
            company_name: "scriTrashPeople",
            year: "2001",
            price: "50",
            total: 20,
            lastProfit: "50",
            buildings: [{
                name: "building1",
                amount: 3
            }, {
                name: "building2",
                amount: 5
            }],
            stock_shares: [{
                name: "stock1",
                amount: 10,
                Annoymous: "12%"
            }, {
                name: "stock",
                amount: 10,
                Annoymous: "20%"
            }]
        }, {
            company_id: "2",
            company_name: "johannaTrashPeople",
            year: "2001",
            price: "50",
            total: "20",
            lastProfit: "70",
            buildings: [{
                name: "building1",
                amount: 3,
            }, {
                name: "building2",
                amount: 5
            }],
            stock_shares: [{
                name: "stock1",
                amount: 3,
                Annoymous: "92%"
            }, {
                name: "stock",
                amount: 10,
                Annoymous: "82%"
            }]
        }];

        var html = '';

        var randomScalingFactor = function () {
            return Math.round(Math.random() * 100);
        };

        function randomColor() {
            var r = Math.floor(Math.random() * 256);
            var g = Math.floor(Math.random() * 256);
            var b = Math.floor(Math.random() * 256);
            return "rgb(" + r + ',' + g + ',' + b + ")";
        }

        function createDom() {
            var configS = [];
            var idS = []

            $.each(receivedInfo, function () {
                idS.push(this.company_id);
                var data = [];
                var backgroundColor = [];
                var labels = [];
                var label = this.company_name;

                for (var i = 0; i < this.stock_shares.length; i++) {
                    data.push(this.stock_shares[i].amount);
                    backgroundColor.push(randomColor());
                    labels.push(this.stock_shares[i].name + "(" + ((this.stock_shares[i].amount / this.total) * 100).toFixed(2) + "%)");
                }

                configS.push({
                    type: 'pie',
                    data: {
                        datasets: [{
                            data: data,
                            backgroundColor: backgroundColor,
                            label: label
                        }],
                        labels: labels
                    },
                    options: {
                        responsive: true
                    }
                });

                html += '<div class="company mdui-col-md-12"> <div class="mdui-card"> <div class="mdui-card-primary">';
                html += '<div class="mdui-card-primary-title">' + this.company_name + '</div> </div> <div class="mdui-card-content">';
                html += '<div id="canvas-holder"> <canvas id="' + this.company_id + '"/> </div> <ul class="mdui-list">';
                html += '<li class="mdui-list-item mdui-ripple">总股数：' + this.total + '</li>';
                html += '<li class="mdui-list-item mdui-ripple">股价：' + this.price + '</li>';
                html += '<li class="mdui-list-item mdui-ripple">去年的利润：' + this.lastProfit + '</li>';
                html += '<li class="mdui-list-item mdui-ripple">公司持有的建筑：<ul class="mdui-list">';
                for (var i = 0; i < this.buildings.length; i++) {
                    html += '<li class="mdui-list-item mdui-ripple">' + this.buildings[i].name + ' X ' + this.buildings[i].amount + '</li>';
                }
                html += '</ul><li class="mdui-list-item mdui-ripple">分红率：<ul class="mdui-list">';
                for (var i = 0; i < this.stock_shares.length; i++) {
                    html += '<li class="mdui-list-item mdui-ripple">' + this.stock_shares[i].name + ': ' + this.stock_shares[i].Annoymous + '</li>';
                }
                html += '</ul></li> </ul> </div> </div> </div>';


            });
            $('#table').html(html);
            for (var i = 0; i < configS.length; i++) {
                var ctx = document.getElementById(idS[i]).getContext("2d");
                window.myPie = new Chart(ctx, configS[i]);
            }
        };


        function information() {
            // $.ajax({
            //     url: "wtfFrontEndIsShit.php",
            //     dataType: "json",
            //     type: "GET",
            //     success: function (msg) {
            //         receivedInfo = msg;
            //     },
            //     error: function () {
            //         alert("qbddbq");
            //     }
            // })
            html = '';
            createDom();
        };

        $(document).ready(function () {
            setTimeout("information()", 500);
        });


        ///////new stuff
        function display() {

        }

        // var data = [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()];
        // var backgroundColor = [];
        // var name = ['red', 'blue']
        // var labels = [];
        // var sum = 0;
        // // sum直接等于总股数
        // // 下面这个循环就先用着到时候删掉
        // for (var i = 0; i < data.length; i++) {
        //     sum += data[i];
        // }
        // //
        // for (var i = 0; i < data.length; i++) {
        //     backgroundColor.push(randomColor());
        // }
        //
        // for (var i = 0; i < name.length; i++) {
        //     labels.push(name[i] + "(" + ((data[i] / sum) * 100).toFixed(2) + "%)");
        // }
        //
        //
        // $(document).ready(function () {
        //     setTimeout("information()", 5000);
        // });
        //
        // var config = {
        //     type: 'pie',
        //     data: {
        //         datasets: [{
        //             data: data,
        //             backgroundColor: backgroundColor,
        //             label: 'Dataset 1'
        //         }],
        //         labels: labels
        //     },
        //     options: {
        //         responsive: true
        //     }
        // };
        //
        // window.onload = function () {
        //     var ctx = document.getElementById("chart-area").getContext("2d");
        //     window.myPie = new Chart(ctx, config);
        // };


    </script>
@endsection

@section('stylesheet')
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
@endsection

@section('body')
    <div class="mdui-container doc-container">
        <div id="title">
            <div class="mdui-center mdui-typo-display-1 mdui-text-center mdui-text-color-white">
                Financial Report
            </div>
        </div>
        <div class="mdui-tab mdui-tab-scrollable" mdui-tab>
            @foreach($yeas as $year)
                <a class="mdui-ripple" onclick="display()">{{$year->index}}</a>
            @endforeach
        </div>
        </br></br>

        <div id="table" class="mdui-col-md-12">
            @foreach($companys as $company)
                <div class="company mdui-col-md-12">
                    <div class="mdui-card">
                        <div class="mdui-card-primary">
                            <div class="mdui-card-primary-title">{{$company -> name}}</div>
                        </div>
                        <div class="mdui-card-content">
                            <div id="canvas-holder">
                                <canvas id="chart-area"/>
                            </div>
                            <ul class="mdui-list">
                                <li class="mdui-list-item mdui-ripple">总股数：{{$company -> total}}</li>
                                <li class="mdui-list-item mdui-ripple">股价：{{$company -> price}}</li>
                                <li class="mdui-list-item mdui-ripple">去年的利润：{{$company -> last_profit}}</li>
                                <li class="mdui-list-item mdui-ripple">
                                    公司持有的建筑：
                                    <ul class="mdui-list">
                                        @foreach($company -> buildings as $building)
                                            <li class="mdui-list-item mdui-ripple">{{$building -> name}}
                                                （数量：{{$building -> amount}}）
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="mdui-list-item mdui-ripple">
                                    分红率：
                                    <ul class="mdui-list">
                                        @foreach($company -> stock_shares as $stock_share)
                                            <li class="mdui-list-item mdui-ripple">{{$stock_share -> name}}
                                                ： {{$stock_share -> Annoymous}}</li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
