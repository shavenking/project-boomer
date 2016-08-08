@inject('projectRepo', 'App\Repos\Contracts\Project')

{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    trans('all.external') => route('projects.external.index', $project->id),
    trans('all.p_construction_daily') => route('projects.construction-dailies.index', $project->id),
    trans('all.construction_daily') => null
] /* --}}

@extends('layouts.project')

@section('content')

    @if ($projectRepo->isRole(request()->user(), $project, 'engineer'))
        <a href="" class="ui green button">送出審核</a>
    @elseif ($projectRepo->isRole(request()->user(), $project, 'field_engineer') || $projectRepo->isRole(request()->user(), $project, 'project_manager'))
        <a href="" class="ui green button">審核通過</a>
    @else
        <div class="ui disabled button">送出審核</div>
    @endif

    <construction-daily project-id="{{ $project->id }}" date="{{ $date }}"></construction-daily>

@stop
