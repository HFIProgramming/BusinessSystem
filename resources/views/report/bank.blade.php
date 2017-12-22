@extends('layouts.base')

@section('title')
    Company Report
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.3/Chart.bundle.js"></script>
    <script>

        var html = '';

        var receivedInfo = [{
            bank_name: "bank1",
            last_profit: 10,
            loan_amount: 100,
            chigu: [{
                name: "company1",
                proportion: "15%"
            }, {
                name: "company2",
                proportion: "20%"
            }, {
                bank_name: "bank2",
                last_profit: 50,
                loan_amount: 500,
                chigu: [{
                    name: "company1",
                    proportion: "35%"
                }, {
                    name: "company2",
                    proportion: "40%"
                }]
            }];

        function createDom() {

            $.each(receivedInfo, function () {
                html += '<div class="company mdui-col-md-12"> <div class="mdui-card"> <div class="mdui-card-primary">';
                html += '<div class="mdui-card-primary-title">' + this.bank_name + '</div> </div> <div class="mdui-card-content">';
                html += '<ul class="mdui-list">';
                html += '<li class="mdui-list-item mdui-ripple">总股数：' + this.total + '</li>';
                html += '<li class="mdui-list-item mdui-ripple">在外贷款数额：' + this.loan_amount + '</li>';
                html += '<li class="mdui-list-item mdui-ripple">去年的利润：' + this.last_profit + '</li>';
                html += '<li class="mdui-list-item mdui-ripple">持股大于10%的公司：<ul class="mdui-list">';
                for (var i = 0; i < this.chigu.length; i++) {
                    html += '<li class="mdui-list-item mdui-ripple">' + this.chigu[i].name + ': ' + this.buildings[i].proportion + '</li>';
                }
                html += '</ul></li> </ul> </div> </div> </div>';
            });
            $('#table').html(html);
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
//            $('#table-1').style.display = "block";
            // setTimeout("information()", 500);

        });


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
        <div class="mdui-tab mdui-tab-scrollable" mdui-tab>
            @foreach($bankReports as $banksYearlyReport)
                <a class="mdui-ripple" onclick="display()" id="{{$banksYearlyReport['year']}}">{{$banksYearlyReport['year']}}</a>
            @endforeach
        </div>
        </br></br>
        <div class="mdui-card-header">
            <div class="mdui-typo-display-1 mdui-text-center mdui-text-color-theme">
                投行报表
            </div>
        </div>
        @foreach($bankReports as $banksYearlyReport)
            <div id="table-{{$banksYearlyReport['year']}}" class="cardId mdui-col-md-12" style="display: none">
                @foreach($banksYearlyReport['data'] as $bank)
                    <div class="company mdui-col-md-12">
                        <div class="mdui-card">
                            <div class="mdui-card-primary">
                                <div class="mdui-card-primary-title">{{$bank['name']}}</div>
                            </div>
                            <div class="mdui-card-content">
                                <div id="canvas-holder">
                                    <canvas id="{{$bank['id']}}"/>
                                </div>
                                <ul class="mdui-list">
                                    <li class="mdui-list-item mdui-ripple">在外贷款金额：{{$bank['loan_total']}}</li>
                                    <li class="mdui-list-item mdui-ripple">
                                        持股大于10%的公司：
                                        <ul class="mdui-list">
                                            @foreach($bank['components'] as $user_id => $share)
                                                <li class="mdui-list-item mdui-ripple">{{\App\User::find($user_id)->company->name}}
                                                    （百分比：{{$share*100}}%）
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection
