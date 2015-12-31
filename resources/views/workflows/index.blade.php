@extends('layouts.general')

@section('title')
    設定 ｜ 流程管理
@stop

@section('sidebar')
    @include('partials.settings-sidebar')
@stop

@section('breadcrumbs')
    <a href="{{ route('settings.index') }}" class="section">設定</a>

    <i class="right chevron icon divider"></i>

    <div class="active section">流程管理</div>
@stop

@section('content')
    <div id="workflow-list"><!-- React Component --></div>
@stop
