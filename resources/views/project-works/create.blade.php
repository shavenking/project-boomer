@extends('layouts.project')

@section('title')
    專案 ｜ {{ $project->name }} ｜ 內部作業 ｜ 標單 ｜ 工作項目列表 ｜ 新增工項
@stop

@section('breadcrumbs')
    <a href="{{ route('projects.index') }}" class="section">專案首頁</a>

    <i class="right chevron icon divider"></i>

    <a href="{{ route('projects.show', $project->id) }}" class="section">{{ $project->name }}</a>

    <i class="right chevron icon divider"></i>

    <a href="{{ route('projects.internal', $project->id) }}" class="section">內部作業</a>

    <i class="right chevron icon divider"></i>

    <a href="{{ route('projects.bid.index', $project->id) }}" class="section">標單</a>

    <i class="right chevron icon divider"></i>

    <a href="{{ route('projects.bid.works', $project->id) }}" class="section">工作項目列表</a>

    <i class="right chevron icon divider"></i>

    <div class="active section">新增工項</div>
@stop

@section('sidebar')
    @include('partials.internal-sidebar')
@stop

@section('content')

    @if (count($errors))
        @include('messages.errors', [
            'header' => '請填寫欄位',
            'message' => '必填項目：參考工項、名稱、數量'
        ])
    @endif

    <div class="ui raised segment">
        @include('components.form-create-project-work', [
            'project' => $project,
            'csrfToken' => csrf_token()
        ])
    </div>

@stop
