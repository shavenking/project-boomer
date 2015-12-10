@extends('layouts.general')

@section('title')
    設定 ｜ 流程管理
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
    <a href="{{ route('workflows.index') }}" class="active item">
        流程管理
    </a>
@stop

@section('breadcrumbs')
    <a href="{{ route('settings.index') }}" class="section">設定</a>

    <i class="right chevron icon divider"></i>

    <div class="active section">流程管理</div>
@stop

@section('content')
    <p>流程管理首頁</p>
@stop
