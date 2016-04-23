{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    trans('all.external') => route('projects.external.index', $project->id),
    trans('all.p_construction_daily') => route('projects.construction-dailies.index', $project->id),
    trans('all.construction_daily') => null
] /* --}}

@extends('layouts.project')

@section('content')

    <construction-daily project-id="{{ $project->id }}" date="{{ $date }}"></construction-daily>

@stop
