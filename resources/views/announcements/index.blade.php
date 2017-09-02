@extends('layouts.base')

@section('title')
    Announcement
@endsection

@section('script')

@endsection

@section('stylesheet')
@endsection

@section('body')
    <div class="mdui-container doc-container">
        @foreach($announcements as $announcement)
            <div class="mdui-row">
                <div class="mdui-col-xs-12">
                    <div class="mdui-card">
                        <div class="mdui-card-header">
                            <img class="mdui-card-header-avatar" src="/img/avg.jpg"/>
                            <div class="mdui-card-header-title">Root</div>
                            <div class="mdui-card-header-subtitle">Published At: {{$announcement->timestamp}}</div>
                        </div>
                        <div class="mdui-card-primary">
                            <div class="mdui-card-primary-title">{{$announcement->title}}</div>
                            <!--<div class="mdui-card-primary-subtitle">Recent Nodes Adjustment</div>-->
                        </div>
                        <div class="mdui-card-content">
                            {{$announcement->content}}
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
        @endforeach
    </div>
@endsection
