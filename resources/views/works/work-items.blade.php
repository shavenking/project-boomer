@extends('layouts.general')

@section('title')
    設定 ｜ 工項管理 ｜ {{ $work->name }} ｜ 工料項目
@stop

@section('sidebar')
    @include('partials.settings-sidebar')
@stop

@section('breadcrumbs')
    <a href="{{ route('settings.index') }}" class="section">設定</a>

    <i class="right chevron icon divider"></i>

    <a href="{{ route('works.index') }}" class="section">工項管理</a>

    <i class="right chevron icon divider"></i>

    <a href="{{ route('works.show', $work->id) }}" class="section">{{ $work->name }}</a>

    <i class="right chevron icon divider"></i>

    <div class="active section">工料項目列表</div>
@stop

@section('content')
    <div class="ui secondary pointing menu">
        <a href="{{ route('works.show', $work->id) }}" class="item">基本資料</a>
        <a href="{{ route('works.work-items.index', $work->id) }}" class="active item">工料項目列表</a>
        <a href="{{ route('works.workflow', $work->id) }}" class="item">流程圖</a>
        <a href="{{ route('works.checklist', $work->id) }}" class="item">Check List</a>
    </div>

    <div id="work-item-list" data-work-id="{{ $work->id }}"></div>
@stop
