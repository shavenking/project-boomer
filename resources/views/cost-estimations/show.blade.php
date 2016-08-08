@inject('projectRepo', 'App\Repos\Contracts\Project')

{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    trans('all.finance') => route('projects.finance.index', $project->id),
    '工程進度估驗計價' => route('projects.cost-estimations.index', $project->id),
    "估驗計價單（ {$date->toDateString()} ）" => null
] /* --}}

@extends('layouts.project')

@section('content')

    @if ($projectRepo->isRole(request()->user(), $project, 'estimation_manager'))
        <a href="" class="ui green button">送出審核</a>
    @elseif ($projectRepo->isRole(request()->user(), $project, 'project_manager'))
        <a href="" class="ui green button">審核通過</a>
    @else
        <div class="ui disabled button">送出審核</div>
    @endif

    <cost-estimation-sheet project-id="{{ $project->id }}" cost-estimation-id="{{ $costEstimation->id }}" date="{{ $date->toDateString() }}"></cost-estimation-sheet>

@stop
