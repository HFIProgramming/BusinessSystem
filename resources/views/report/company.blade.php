@extends('layouts.base')

@section('title')
    Company Report
@endsection

@section('script')
    <script src="js/Chart.bundle.js"></script>
    <script>

        var receivedInfo = {
            year: 1,
            info: [{
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
            }]
        };

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


        ///////new stuff
        function display() {

//            console.log(event);

            var matchId = 'table-' + event.target.id;
            var selected;
            $('.mdui-container').children('.cardId').each(function () {
                if (this.id === matchId) {
                    document.getElementById(this.id).style.display = "block";
                } else {
                    document.getElementById(this.id).style.display = "none";
                }

            })

        }

        $(document).ready(function () {

           $('#table-1').style.display = "block";
            // setTimeout("information()", 500);

        });

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
            <div class="mdui-center mdui-typo-display-1 mdui-text-center mdui-text-color-theme">
                Financial Report
            </div>
        </div>
        <div class="mdui-tab mdui-tab-scrollable" mdui-tab>
            @foreach($companyReports as $companyReport)
                <a class="mdui-ripple" onclick="display()"
                   id="{{$companyReport['year']}}">{{$companyReport['year']}}</a>
            @endforeach
        </div>
        <br><br>

        <canvas id="test"></canvas>

        {{--        {{var_dump($companyReports)}}--}}

        @foreach($companyReports as $companyReport)
            <div id="table-{{$companyReport['year']}}" class="cardId mdui-col-md-12" style="display: none">
                @foreach($companyReport['info'] as $company)
                    <div class="company mdui-col-md-12">
                        <div class="mdui-card">
                            <div class="mdui-card-primary">
                                <div class="mdui-card-primary-title">{{$company['name']}}</div>
                            </div>
                            <div class="mdui-card-content">
                                <div id="canvas-holder">
                                    <canvas id="{{$company['id']}}"/>
                                </div>
                                <ul class="mdui-list">
                                    <li class="mdui-list-item mdui-ripple">总股数：{{$company['total']}}</li>
                                    <li class="mdui-list-item mdui-ripple">股价：{{$company['price']}}</li>
                                    <li class="mdui-list-item mdui-ripple">当年利润（分红前）：{{$company['last_profit']}}</li>
                                    <li class="mdui-list-item mdui-ripple">
                                        公司持有的建筑：
                                        <ul class="mdui-list">
                                            @foreach($company['buildings'] as $building)
                                                <li class="mdui-list-item mdui-ripple">{{$building['name']}}
                                                    （数量：{{$building['amount']}}）
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li class="mdui-list-item mdui-ripple">分红率：{{$company['dividend']}}</li>
                                    <li class="mdui-list-item mdui-ripple">欠款未还：{{$company['unredeemed_loan']}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{--@endforeach--}}

            <script>
                var data = [];
                var backgroundColor = [];
                var labels = [];
                var label = "{{$company['name']}}";
                var sum = 0;

                {{--@foreach($company['datas'] as $data)--}}
                {{--data.push({{$data}})--}}
                {{--backgroundColor.push(randomColor());--}}
                {{--@endforeach--}}

                @foreach($company['stock_shares'] as $id => $percent)
                data.push({{$percent}});
                backgroundColor.push(randomColor());
                labels.push({{$id}} +
                        "(" +
                    "{{ $percent * 100}}".toFixed(2) +
                    "%)");
                sum = sum + {{$percent}};
                @endforeach


                data.push(1-sum);
                backgroundColor.push(randomColor());
                labels.push("anno(" +
                    ((1-sum)*100).toFixed(2) +
                    "%)");



                var config = ({
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


                var ctx = document.getElementById("{{$company['id']}}").getContext("2d");
                window.myPie = new Chart(ctx, config);
            </script>
        @endforeach
    </div>

    {{--@endforeach--}}
    {{--</div>--}}
@endsection
