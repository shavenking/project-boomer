@extends('layouts.general')

@section('title')
    設定 ｜ 流程管理 ｜ 新增
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

    <div class="active section">新增</div>
@stop

@section('content')

    <form class="ui form {{ count($errors) ? 'error' : '' }}" action="{{ route('workflows.store') }}" method="POST">
        {{ csrf_field() }}

        <div class="field {{ $errors->has('name') ? 'error' : '' }}">
            <label>名稱</label>
            <input type="text" name="name">
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