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

    <div class="ui secondary pointing menu">
        <a href="{{ route('works.show', $work->id) }}" class="active item">基本資料</a>
        <a href="{{ route('works.work-items.index', $work->id) }}" class="item">工料項目列表</a>
        <a href="{{ route('works.workflow', $work->id) }}" class="item">流程圖</a>
    </div>

    <div class="ui card">
        <div class="content">
            <div class="header">{{ $work->name }}</div>
            <div class="meta">
                <span>{{ $work->detailingflowType->mainflowType->name }} - {{ $work->detailingflowType->name }}</span>
            </div>
            <div class="description">
            </div>
        </div>
        <div class="extra content">
            <div class="ui label">{{ $work->unit->name }}</div>
        </div>
    </div>

@stop
