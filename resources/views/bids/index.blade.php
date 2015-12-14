@extends('layouts.project')

@section('title')
    專案 ｜ {{ $project->name }} ｜ 內部作業 ｜ 標單
@stop

@section('breadcrumbs')
    <a href="{{ route('projects.index') }}" class="section">專案首頁</a>

    <i class="right chevron icon divider"></i>

    <a href="{{ route('projects.show', $project->id) }}" class="section">{{ $project->name }}</a>

    <i class="right chevron icon divider"></i>

    <a href="{{ route('projects.internal', $project->id) }}" class="section">內部作業</a>

    <i class="right chevron icon divider"></i>

    <div class="active section">標單</div>
@stop

@section('sidebar')
    <a href="{{ route('projects.bid.index', $project->id) }}" class="active item">
        標單管理
    </a>
@stop

@section('content')

    <div class="ui secondary pointing menu">
        <a href="{{ route('projects.bid.index', $project->id) }}" class="active item">基本資料</a>
        <a href="{{ route('projects.bid.works', $project->id) }}" class="item">工作項目列表</a>
    </div>

    <p>基本茲ㄌㄧㄠ</p>
@stop
