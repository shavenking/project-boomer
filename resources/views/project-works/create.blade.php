{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    trans('all.bid') => route('projects.bid.index', $project->id),
    trans_choice('all.works', 2) => route('projects.bid.works', $project->id),
    trans('all.create') => null
] /* --}}

@extends('layouts.project')

@section('content')

    @if (count($errors))
        @include('messages.errors', [
            'header' => trans('all.please_fill_the_form'),
            'message' => trans('all.required_fields', ['fields' => implode(['Referenced Work', 'Name', 'Amount'])])
        ])
    @endif

    <div class="ui raised segment">
        @include('components.form-create-project-work', [
            'project' => $project,
            'csrfToken' => csrf_token()
        ])
    </div>

@stop
