{{-- */ $breadcrumbs = [
    'Projects' => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    'Checklists' => null
] /* --}}

@extends('layouts.project')

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
