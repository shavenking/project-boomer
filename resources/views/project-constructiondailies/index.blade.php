{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    trans('all.p_construction_daily') => null
] /* --}}

@extends('layouts.project')

@section('content')

    <a href="{{ route('projects.construction-dailies.show', [$project->id, 'today']) }}" class="ui primary button">
        本日施工日報表
    </a>
@stop
