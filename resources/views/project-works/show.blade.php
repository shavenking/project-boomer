{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    trans('all.p_bid') => route('projects.bid.works', $project->id),
    "{$work->name}" => null
] /* --}}

@extends('layouts.project')

@section('content')

    <project-workitem-list
        project-id="{{ $project->id }}"
        work-id="{{ $work->id }}"
    ></project-workitem-list>

@stop
