@extends('layouts.general')

@section('title')
    設定 ｜ 工項管理 ｜ {{ $work->name }}
@stop

@section('sidebar')
    <a href="{{ route('workflows.index') }}" class="item">
        流程管理
    </a>

    <a href="{{ route('works.index') }}" class="active item">
        工項管理
    </a>
@stop

@section('breadcrumbs')
    <a href="{{ route('settings.index') }}" class="section">設定</a>

    <i class="right chevron icon divider"></i>

    <a href="{{ route('works.index') }}" class="section">工項管理</a>

    <i class="right chevron icon divider"></i>

    <div class="active section">{{ $work->name }}</div>
@stop

@section('content')

    <div class="ui tabular pointing secondary menu" id="work-tabular-meun">
        <a class="item" data-tab="work-item-list">工料項目列表</a>
        <a class="active item" data-tab="workflow">流程</a>
    </div>

    <div class="ui tab" data-tab="work-item-list">
        <div id="work-item-list" data-work-id="{{ $work->id }}"></div>
    </div>
    <div class="ui active tab" data-tab="workflow">
        <div id="workflow-node-list" data-workflow-id="{{ $work->workflow->id }}"></div>
    </div>

@stop
