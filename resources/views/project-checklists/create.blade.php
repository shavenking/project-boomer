@extends('layouts.project')

@section('title')
    Projects | {{ $project->name }} | External | Checklists | Add To Project
@stop

@section('breadcrumbs')
    <a href="{{ route('projects.index') }}" class="section">Projects</a>

    <i class="right chevron icon divider"></i>

    <a href="{{ route('projects.show', $project->id) }}" class="section">{{ $project->name }}</a>

    <i class="right chevron icon divider"></i>

    <a href="{{ route('projects.external', $project->id) }}" class="section">External</a>

    <i class="right chevron icon divider"></i>

    <a href="{{ route('projects.checklists.index', $project->id) }}" class="section">Checklists</a>

    <i class="right chevron icon divider"></i>

    <div class="active section">Add To Project</div>
@stop

@section('sidebar')
    @include('partials.external-sidebar')
@stop

@section('content')

    @if (count($errors))
        @include('messages.errors', [
            'header' => 'Please fill up the form.',
            'message' => 'Required: Referenced Checklist, Custom Name'
        ])
    @endif

    <div class="ui raised segment">
        @include('project-checklists.form-create')
    </div>

@stop
