@extends('layouts.admin')

@section('body')
    <div class="mdui-container doc-container">
        <div class="mdui-row">
            <div class="mdui-col-xs-12">
                <form action="{{ route('updateMiners') }}" method="post" enctype="application/json">
                    {{ csrf_field() }}
                    <div class="mdui-card-header">
                        <div class="mdui-typo-display-2 mdui-text-center mdui-text-color-theme">
                            Miner List
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
                                    <th>Name</th>
                                    <th>Employment Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($miners as $miner)
                                    <tr>
                                        <td>{{ $miner->name }}</td>
                                        <td class="mdui-textfield">
                                            <input class="mdui-textfield-input" type="text"
                                                   value="{{ $miner->employment_price }}"
                                                   name="miners[{{$miner->id}}]"/>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div>
                        &nbsp&nbsp&nbsp&nbsp
                        <button type="submit" class="mdui-btn mdui-btn-raised mdui-ripple">全部更新
                        </button>
                    </div>
                </form>
            </div>

        </div>


    </div>
@endsection