@extends('layouts.general')

@section('title')
    設定 ｜ 工項管理 ｜ 新增
@stop

@section('sidebar')
    <a href="{{ route('workflows.index') }}" class="item">
        施工流程管理
    </a>

    <a href="{{ route('works.index') }}" class="active item">
        工作項目管理
    </a>

    <a href="{{ route('check-lists.index') }}" class="item">
        自主檢查表管理
    </a>
@stop

@section('breadcrumbs')
    <a href="{{ route('settings.index') }}" class="section">設定</a>

    <i class="right chevron icon divider"></i>

    <a href="{{ route('works.index') }}" class="section">工項管理</a>

    <i class="right chevron icon divider"></i>

    <div class="active section">新增</div>
@stop

@section('content')
    <form class="ui form {{ count($errors) ? 'error' : '' }}" method="POST" action="{{ route('works.store') }}">
        {{ csrf_field() }}
        <div id="flowtype-select"></div>

        <div class="grouped fields">
                <div id="unit-select"></div>
        </div>

        <div class="grouped fields">
            <div id="workflow-select"></div>
        </div>

        <div class="equal width fields">
            <div class="field {{ $errors->has('name') ? 'error' : '' }}">
                <label>名稱</label>
                <input type="text" name="name" placeholder="名稱">
            </div>
            <div class="field {{ $errors->has('amount') ? 'error' : '' }}">
                <label>數量</label>
                <input type="text" name="amount" placeholder="數量">
            </div>
        </div>

        @if (count($errors))
            <div class="ui error message">
                <div class="header">錯誤！</div>
                <p>欄位請勿留空</p>
            </div>
        @endif

        <button class="ui primary button" type="submit">新增</button>
    </div>
@stop
