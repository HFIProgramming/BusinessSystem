@extends('layouts.base')

@section('title')
    Bank Report
@endsection

@section('script')
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.3/Chart.bundle.js"></script>--}}
    <script>

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

            document.getElementById("table-1").style.display = "block";
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
        <div class="mdui-card-header">
            <div class="mdui-typo-display-1 mdui-text-center mdui-text-color-theme">
                投行报表
            </div>
        </div>

        </br></br>

        <div class="mdui-tab mdui-tab-scrollable" mdui-tab>
            @foreach($bankReports as $banksYearlyReport)
                <a class="mdui-ripple" onclick="display()"
                   id="{{$banksYearlyReport['year']}}">{{$banksYearlyReport['year']}}</a>
            @endforeach
            {{--@foreach($bankReports as $banksYearlyReport)--}}
                {{--<a class="mdui-ripple" onclick="display()" id="{{$banksYearlyReport['year']}}">{{$banksYearlyReport['year']}}</a>--}}
            {{--@endforeach--}}
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
