@extends('layouts.base')

@section('title')
    New Transaction
@endsection

@section('script')

@endsection

@section('stylesheet')
    <style>
        /*.adjust_card {*/
        /*padding-top: 100px;*/
        /*padding-bottom: 200px;*/
        /*}*/

        .adjust_card_subtitle {
            margin-left: 0;
        }

        /*.adjust_remember {*/
        /*margin-left: 9px;*/
        /*}*/

        .adjust_mdui_icon {
            bottom: 33px !important;
        }
    </style>
@endsection

@section('body')
    <div class="mdui-container doc-container">
        <div class="mdui-row">
            <div class="mdui-col-xs-12">

                <div class="mdui-card-header">
                    <div class="mdui-typo-display-2 mdui-text-center mdui-text-color-theme">
                        Resource List
                    </div>
                </div>

                <div class="mdui-card-header-subtitle adjust_card_subtitle">
                    <div class="mdui-text-center">
                        便捷金融生活从此开启
                    </div>
                </div>
                <div class="mdui-card-content mdui-typo">
                    <br>
                    <div class="mdui-table-fluid">
                        <table class="mdui-table">
                            <thead>
                            <tr>
                                <th></th>
                                <th>id</th>
                                <th>Name</th>
                                <th>Descrption</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Larry the Bird</td>
                                <td></td>
                                <td>@twitter</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <!--row-->
        </div>
    </div>
@endsection
