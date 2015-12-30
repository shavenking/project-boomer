@extends('layouts.general')

@section('title')
    設定 ｜ 流程管理
@stop

@section('sidebar')
    <a href="{{ route('workflows.index') }}" class="active item">
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
    <a href="{{ route('settings.index') }}" class="section">設定</a>

    <i class="right chevron icon divider"></i>

    <div class="active section">流程管理</div>
@stop

@section('content')
    <div id="workflow-list"><!-- React Component --></div>
@stop
