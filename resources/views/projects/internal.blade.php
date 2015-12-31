@extends('layouts.project')

@section('title')
    專案 ｜ {{ $project->name }} ｜ 內部作業
@stop

@section('breadcrumbs')
    <a href="{{ route('projects.index') }}" class="section">專案首頁</a>

    <i class="right chevron icon divider"></i>

    <a href="{{ route('projects.show', $project->id) }}" class="section">{{ $project->name }}</a>

    <i class="right chevron icon divider"></i>

    <div class="active section">內部作業</div>
@stop

@section('sidebar')
    @include('partials.internal-sidebar')
@stop

@section('content')
    專案： {{ $project->name }} 內部作業
@stop
