{{-- */ $breadcrumbs = [
    'Settings' => route('settings.index'),
    'Works' => route('works.index'),
    "Create" => null
] /* --}}

@extends('layouts.general')

@section('sidebar')
    @include('partials.settings-sidebar')
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
