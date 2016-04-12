{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    trans('all.p_construction_dailies') => null
] /* --}}

@extends('layouts.project')

@section('content')

    <construction-daily project-id="{{ $project->id }}" date="{{ $date }}"></construction-daily>

@stop
