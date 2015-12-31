@extends('layouts.general')

@section('title')
    設定 ｜ 流程管理 ｜ 新增
@stop

@section('sidebar')
    @include('partials.settings-sidebar')
@stop

@section('breadcrumbs')
    <a href="{{ route('settings.index') }}" class="section">設定</a>

    <i class="right chevron icon divider"></i>

    <a href="{{ route('workflows.index') }}" class="section">流程管理首頁</a>

    <i class="right chevron icon divider"></i>

    <div class="active section">新增</div>
@stop

@section('content')

    <form class="ui form {{ count($errors) ? 'error' : '' }}" action="{{ route('workflows.store') }}" method="POST">
        {{ csrf_field() }}

        <div class="field {{ $errors->has('name') ? 'error' : '' }}">
            <label>名稱</label>
            <input type="text" name="name">
        </div>

        <div class="fields">
            <div id="work-select"></div>
        </div>

        @if ($errors->has('name'))
            <div class="ui error message">
                <div class="header">錯誤！</div>
                <p>欄位請勿留空</p>
            </div>
        @endif

        <button class="ui primary button" type="submit">新增</button>

    </form>

@stop
