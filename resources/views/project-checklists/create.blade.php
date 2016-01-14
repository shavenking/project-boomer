{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    trans_choice('all.checklists', 2) => route('projects.checklists.index', $project->id),
    trans('all.create') => null
] /* --}}

@extends('layouts.project')

@section('content')

    @if (count($errors))
        @include('messages.errors', [
            'header' => trans('all.please_fill_the_form'),
            'message' => trans('all.required_fields', ['fields' => implode(', ', ['Referenced Checklist', 'Custom Name'])])
        ])
    @endif

    <div class="ui raised segment">
        @include('project-checklists.form-create')
    </div>

@stop
