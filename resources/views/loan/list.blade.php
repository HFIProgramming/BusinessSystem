@extends('layouts.base')

@section('title')
  Transaction List
@endsection

@section('script')

@endsection

@section('stylesheet')

@endsection

@section('body')
  <div class="mdui-container doc-container">
    <div class="mdui-row">
      <div class="adjust_card mdui-col-xs-12">

        <div class="mdui-card-header">
          <div class="mdui-typo-display-2 mdui-text-center mdui-text-color-theme">
            Transaction List
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
                  <th>我借出的</th>
                  <th>我借来的</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <table class="mdui-table">
                      <thead>
                        <tr>
                          <th>收款人</th>
                          <th>金额</th>
                          <th>利息</th>
                          <th>状态</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          @foreach($meOut as $loan)
                            <td>{{$loan->debtor->name}}</td>
                            <td>{{$loan->amount}}</td>
                            <td>{{$loan->interest}}</td>
                            @if ($loan->status == 'pending')
                              <td>未收</td>
                            @elseif ($loan->status == 'declined')
                              <td>拒收</td>
                            @elseif ($loan->status == 'accepted')
                              <td>已收未还</td>
                            @elseif ($loan->status == 'redemmed')
                              <td>已还</td>
                            @endif
                          @endforeach
                        </tr>
                      </tbody>
                    </table>
                  </td>
                  <td>
                    <table class="mdui-table">
                      <thead>
                        <tr>
                          <th>借款人</th>
                          <th>金额</th>
                          <th>利息</th>
                          <th>状态</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          @foreach($meIn as $loan)
                            <td>{{$loan->creditor->name}}</td>
                            <td>{{$loan->amount}}</td>
                            <td>{{$loan->interest}}</td>
                            @if ($loan->status == 'pending')
                              <td>
                                <form action="{{ route('handleLoan') }}" method="post">
                                  {{ csrf_field() }}
                                  <input type="hidden" name="loan_id"
                                  value={{$loan->id}}>
                                  <button type="submit" name="confirm" value="true"
                                  class="mdui-btn mdui-btn-icon mdui-color-green mdui-ripple">
                                  <i class="mdui-icon material-icons">check</i>
                                </button>
                                <button type="submit" name="confirm" value="false"
                                class="mdui-btn mdui-btn-icon mdui-color-green mdui-ripple">
                                <i class="mdui-icon material-icons">close</i>
                              </button>
                              </form>
                            </td>
                          @elseif ($loan->status == 'accepted')
                            <td>
                              <form action="{{ route('redeemLoan') }}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="confirm"
                                value={{$loan-id}}>
                                <button type="submit" name="confirm"
                                class="mdui-btn mdui-btn-icon mdui-color-green mdui-ripple">
                                <i class="mdui-icon material-icons">check</i>
                              </button>
                            </td>
                          @endif
                        @endforeach
                      </tr>
                    </tbody>
                  </table>
                </td>
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
