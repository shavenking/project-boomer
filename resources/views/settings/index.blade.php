@extends('layouts.general')

@section('title')
    設定
@stop

@section('navbar')
    <div class="header item">
        公司名稱
    </div>

    <div class="right menu">
        <a href="{{ route('settings.index') }}" class="active item">
            設定
        </a>
    </div>
@stop

@section('sidebar')
    <a href="{{ route('workflows.index') }}" class="item">
        施工流程管理
    </a>

    <a href="{{ route('works.index') }}" class="item">
        工作項目管理
    </a>

    <a href="{{ route('check-lists.index') }}" class="item">
        自主檢查表管理
    </a>
@stop

@section('breadcrumbs')
    <div class="active section">設定</div>
@stop

@section('content')
    <p>設定首頁</p>
@stop
