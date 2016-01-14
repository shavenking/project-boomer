{{-- */ $breadcrumbs = [
    'Projects' => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    'Checklists' => route('projects.checklists.index', $project->id),
    'Create' => null
] /* --}}

@extends('layouts.project')

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
