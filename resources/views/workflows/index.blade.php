@extends('layouts.general')

@section('title')
    設定 ｜ 流程管理
@stop

@section('navbar')
    @include('partials.navbar')
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
    <div id="workflow-list"><!-- React Component --></div>
@stop

@section('react.components')
    <script type="text/babel" src="/js/workflow-list.js"></script>
@stop
