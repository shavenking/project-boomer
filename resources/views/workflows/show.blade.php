@extends('layouts.general')

@section('title')
    設定 ｜ 流程管理 ｜ {{ $workflow->name }}
@stop

@section('sidebar')
    <a href="{{ route('workflows.index') }}" class="active item">
        流程管理
    </a>

    <a href="{{ route('works.index') }}" class="item">
        工項管理
    </a>
@stop

@section('breadcrumbs')
    <a href="{{ route('settings.index') }}" class="section">設定</a>

    <i class="right chevron icon divider"></i>

    <a href="{{ route('workflows.index') }}" class="section">流程管理首頁</a>

    <i class="right chevron icon divider"></i>

    <div class="active section">{{ $workflow->name }}</div>
@stop

@section('content')
    <div id="workflow-node-list" data-workflow-id="{{ $workflow->id }}"><!-- React Component --></div>
@stop
