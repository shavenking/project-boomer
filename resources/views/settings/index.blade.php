{{-- */ $breadcrumbs = [
    'Settings' => null
] /* --}}

@extends('layouts.general')

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

@section('content')
    <p>設定首頁</p>
@stop
