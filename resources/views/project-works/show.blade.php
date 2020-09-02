@inject('reviewRepo', 'App\Repos\ReviewRepo')
{{-- */
    $isLocked = $reviewRepo->isLocked('bid', $project->id);
/* --}}

{{-- */ $breadcrumbs = [
    trans('all.projects') => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    trans('all.internal') => route('projects.internal.index', $project->id),
    trans('all.p_bid') => route('projects.bid.works', $project->id),
    "{$work->name}"  => null
] /* --}}

@extends('layouts.project')

@section('content')

    <h3>工料單價分析表</h3>

    <project-workitem-list
        project-id="{{ $project->id }}"
        work-id="{{ $work->id }}"
        is-locked="{{ $isLocked }}"
    ></project-workitem-list>

@stop
