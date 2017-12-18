@extends('layouts.base')

@section('title')
    New In Transaction
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
                            New In Lending
                        </div>
                    </div>
                    <div class="mdui-card-header-subtitle adjust_card_subtitle">
                        <div class="mdui-text-center">
                            ??????????
                        </div>
                    </div>
                    <div class="mdui-card-content mdui-typo">
                        <form method="post" action="{{route('grantLoan')}}">
                            {{ csrf_field() }}
                            <div class="mdui-textfield mdui-textfield-floating-label">
                                <i class="mdui-icon material-icons adjust_mdui_icon">shopping_basket</i>
                                <label class="mdui-textfield-label">金额</label>
                                <input class="mdui-textfield-input" name="amount" type="text" required/>
                                <div class="mdui-textfield-error">金额不能为空</div>
                            </div>
                            <div class="mdui-textfield mdui-textfield-floating-label ">
                                <i class="mdui-icon material-icons adjust_mdui_icon">add</i>
                                <label class="mdui-textfield-label">利息</label>
                                <input class="mdui-textfield-input" name="interest" type="text" required/>
                                <div class="mdui-textfield-error">利息不能为空</div>
                            </div>
                            <div class="mdui-textfield mdui-textfield-floating-label ">
                                <i class="mdui-icon material-icons adjust_mdui_icon">account_circle</i>
                                <label class="mdui-textfield-label">收款人ID</label>
                                <input class="mdui-textfield-input" name="debtor_id" type="number" required/>
                                <div class="mdui-textfield-error">收款人ID不能为空</div>
                            </div>
                            <input hidden id="transaction_type" value="buy">
                            <button data-no-instant class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme mdui-center">??
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!--row-->
        </div>
    </div>
@endsection
