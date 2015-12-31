@extends('layouts.general')

@section('title')
    設定
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
    @include('partials.settings-sidebar')
@stop

@section('breadcrumbs')
    <div class="active section">設定</div>
@stop

@section('content')
    <p>設定首頁</p>
@stop
