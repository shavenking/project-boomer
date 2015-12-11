@extends('layouts.general-nosidebar')

@section('title')
    專案 ｜ 新增
@stop

@section('breadcrumbs')
    <a href="{{ route('projects.index') }}" class="section">專案首頁</a>

    <i class="right chevron icon divider"></i>

    <div class="active section">新增</div>
@stop

@section('content')

    <form class="ui form {{ count($errors) ? 'error' : '' }}" action="{{ route('projects.store') }}" method="POST">
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
