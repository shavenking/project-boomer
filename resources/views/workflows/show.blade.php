@extends('layouts.general')

@section('title')
    設定 ｜ 流程管理 ｜ {{ $workflow->name }}
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

    <a href="{{ route('workflows.index') }}" class="section">流程管理首頁</a>

    <i class="right chevron icon divider"></i>

    <div class="active section">{{ $workflow->name }}</div>
@stop

@section('content')
    <div id="workflow-node-list"><!-- React Component --></div>
@stop

@section('react.components')
    <script>
        window.workflowId = parseInt('{{ $workflow->id }}');
        window.csrfToken = "{{ csrf_token() }}";
    </script>
    <script type="text/babel" src="/js/workflow-node-list.js"></script>
@stop
