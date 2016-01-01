@extends('layouts.project')

@section('title')
    Projects | {{ $project->name }} | External | Checklists
@stop

@section('breadcrumbs')
    <a href="{{ route('projects.index') }}" class="section">Projects</a>

    <i class="right chevron icon divider"></i>

    <a href="{{ route('projects.show', $project->id) }}" class="section">{{ $project->name }}</a>

    <i class="right chevron icon divider"></i>

    <a href="{{ route('projects.external', $project->id) }}" class="section">External</a>

    <i class="right chevron icon divider"></i>

    <div class="active section">Checklists</div>
@stop

@section('sidebar')
    @include('partials.external-sidebar')
@stop

@section('content')

    <a href="{{ route('projects.checklists.create', $project->id) }}" class="ui primary button">
        <i class="plus icon"></i> Add Check List
    </a>

    <div class="ui raised segment">
        <ol class="ui relaxed list">
            @foreach ($project->checklists as $checklist)
                <li><a href="{{ route('projects.checklists.show', [$project->id, $checklist->id]) }}" class="header">{{ $checklist->name }}</a></li>
            @endforeach
        </ol>
    </div>

@stop
