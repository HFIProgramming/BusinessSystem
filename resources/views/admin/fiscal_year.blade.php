@extends('layouts.admin')

@section('body')
    <div class="mdui-container doc-container">
        <div class="mdui-row">
            <div class="mdui-col-xs-12">
                <br><br>

                <div class="mdui-col-xs-12 mdui-card">
                    <br>
                    <div class="mdui-card-header mdui-text-center">
                        <div class="mdui-card-primary-title">当前财年：{{ $current }}</div>
                        <div class="mdui-card-primary-title">
                            当前比赛状态：{{ \App\Config::KeyValue('is_continued')->value == true ? '正在进行' : '暂停中' }}</div>
                    </div>
                    <div class="mdui-text-center">
                        <br><br>
                        <form method="post" action="{{ route('changeCurrentRound') }}">
                            {{ csrf_field() }}
                            <button type="submit" name="increment" value="-1"
                                    class="mdui-btn mdui-btn-raised mdui-color-theme-accent mdui-ripple">
                                <i class="mdui-icon material-icons">keyboard_arrow_left</i>
                                上一年
                            </button>
                            <button type="submit" name="increment" value="1"
                                    class="mdui-btn mdui-btn-raised mdui-color-theme-accent mdui-ripple mdui-col-offset-xs-1">
                                <i class="mdui-icon material-icons">keyboard_arrow_right</i>
                                下一年
                            </button>
                            <button type="submit" name="condition" value="1"
                                    class="mdui-btn mdui-btn-raised mdui-color-theme-accent mdui-ripple mdui-col-offset-xs-1">
                                <i class="mdui-icon material-icons">keyboard_arrow_right</i>
                                开始
                            </button>
                            <button type="submit" name="condition" value="0"
                                    class="mdui-btn mdui-btn-raised mdui-color-theme-accent mdui-ripple mdui-col-offset-xs-1">
                                <i class="mdui-icon material-icons">keyboard_arrow_right</i>
                                暂停
                            </button>
                        </form>
                    </div>
                    <br><br><br>
                    <form method="post" action="{{ route('changeTotalRound') }}">
                        {{ csrf_field() }}
                        <div class="mdui-textfield mdui-textfield-floating-label mdui-col-offset-xs-1">
                            <label class="mdui-textfield-label">总财年数</label>
                            <input class="mdui-textfield-input" name="total_round" value="{{ $total }}" type="text"/>
                        </div>
                        <div>
                            <br><br>
                            <button type="submit" class="mdui-btn mdui-btn-raised mdui-ripple mdui-col-offset-xs-1">
                                保存
                            </button>
                        </div>
                    </form>
                    <br><br>
                </div>
            </div>
        </div>
    </div>
@endsection