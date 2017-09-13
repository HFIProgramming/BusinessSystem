@extends('layouts.admin')

@section('title')
    Add Announcement
@endsection

@section('script')

@endsection

@section('stylesheet')
@endsection

@section('body')
    <div class="mdui-container doc-container">
        <div class="mdui-row">
            <div class="mdui-col-xs-12">
                <div class="mdui-card">
                    <div class="mdui-card-header">
                        <div class="mdui-typo-display-2 mdui-text-center mdui-text-color-theme">
                            Add New Announcement
                        </div>
                    </div>
                    <div class="mdui-card-header-subtitle adjust_card_subtitle">
                        <div class="mdui-text-center">
                            便捷金融生活从此开启
                        </div>
                    </div>
                    <div class="mdui-card-content mdui-typo">
                        <form method="post">
                            {{ csrf_field() }}
                            <div class="mdui-textfield mdui-textfield-floating-label">
                                <i class="mdui-icon material-icons adjust_mdui_icon">title</i>
                                <label class="mdui-textfield-label">标题</label>
                                <input class="mdui-textfield-input" id="title" name="title" type="text" required/>
                                <div class="mdui-textfield-error">标题不能为空</div>
                            </div>
                            <div class="mdui-textfield mdui-textfield-floating-label">
                                <i class="mdui-icon material-icons adjust_mdui_icon">content_paste</i>
                                <label class="mdui-textfield-label">内容</label>
                                <textarea class="mdui-textfield-input" id="content" name="content" type="text"
                                          required></textarea>
                                <div class="mdui-textfield-error">内容不能为空</div>
                            </div>
                            <input hidden id="transaction_type" value="buy">
                            <button
                                    class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme mdui-center">提交
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!--row-->
        </div>
    </div>
@endsection
