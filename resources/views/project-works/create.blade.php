{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    trans('all.internal') => route('projects.internal.index', $project->id),
    trans('all.p_bid') => route('projects.bid.works', $project->id),
    trans('all.create_work') => null,
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
        <form-create-project-work
            action="{{ route('projects.works.store', $project->id) }}"
            project-id="{{ $project->id }}"
            back-url="{{ route('projects.bid.works', $project->id) }}"
            setting-work-url="{{ route('works.create') }}"
        >
            {{ csrf_field() }}
        </form-create-project-work>
    </div>

@stop
