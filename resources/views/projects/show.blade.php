@extends('layouts.project-nosidebar')

@section('title')
    專案 ｜ {{ $project->name }}
@stop

@section('navbar')
    @include('partials.navbar')
@stop

@section('breadcrumbs')
    <a href="{{ route('projects.index') }}" class="section">專案首頁</a>

    <i class="right chevron icon divider"></i>

    <div class="active section">{{ $project->name }}</div>
@stop

@section('content')
    專案： {{ $project->name }} 首頁
@stop
