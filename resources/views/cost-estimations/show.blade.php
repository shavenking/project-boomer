@inject('projectRepo', 'App\Repos\Contracts\Project')
@inject('reviewRepo', 'App\Repos\ReviewRepo')
{{-- */
    $isLocked = $reviewRepo->isLocked('cost_estimation', $costEstimation->id)
/* --}}

{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    trans('all.finance') => route('projects.finance.index', $project->id),
    '工程進度估驗計價' => route('projects.cost-estimations.index', $project->id),
    "估驗計價單（ {$date->toDateString()} ）" => null
] /* --}}

@extends('layouts.project')

@section('content')

    <div class="sixteen wide column">
        <review-btns
            project-id="{{ $project->id }}"
            resource-type="cost_estimation"
            resource-id="{{ $costEstimation->id }}"
        ></review-btns>
    </div>

    <cost-estimation-sheet project-id="{{ $project->id }}" cost-estimation-id="{{ $costEstimation->id }}" date="{{ $date->toDateString() }}" is-locked="{{ $isLocked }}"></cost-estimation-sheet>

@stop
