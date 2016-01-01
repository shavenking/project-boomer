@extends('layouts.project')

@section('title')
    Projects ｜ {{ $project->name }} ｜ External
@stop

@section('breadcrumbs')
    <a href="{{ route('projects.index') }}" class="section">Projects</a>

    <i class="right chevron icon divider"></i>

    <a href="{{ route('projects.show', $project->id) }}" class="section">{{ $project->name }}</a>

    <i class="right chevron icon divider"></i>

    <div class="active section">External</div>
@stop

@section('sidebar')
    @include('partials.external-sidebar')
@stop

@section('content')
    External
@stop
