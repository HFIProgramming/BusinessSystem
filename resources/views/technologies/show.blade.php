@extends('layouts.base')

@section('body')
    <div class="mdui-container doc-container">
        <div class="mdui-row">
            <div class="mdui-col-xs-12">

                <div class="mdui-card-header">
                    <div class="mdui-typo-display-2 mdui-text-center mdui-text-color-theme">
                        科技树升级
                    </div>
                </div>

                <div class="mdui-card-header-subtitle adjust_card_subtitle">
                    <div class="mdui-text-center">
                        便捷金融生活从此开启
                    </div>
                </div>
                <br><br>
                <div class="mdui-col-xs-12 mdui-card">
                    <br>
                    <div class="mdui-card-header">
                        <div class="mdui-card-primary-title">当前等级：{{ $level }}</div>
                    </div>
                    <div>
                        <br><br>
                        &nbsp&nbsp&nbsp&nbsp<button onclick="window.location.href='{{ route('updateTech') }}';" class="mdui-btn mdui-btn-raised mdui-ripple">升级</button>
                    </div>
                    <br><br>
                </div>
            </div>


            <!--row-->
        </div>

    </div>
@endsection