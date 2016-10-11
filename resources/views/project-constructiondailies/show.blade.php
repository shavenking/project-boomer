@inject('projectRepo', 'App\Repos\Contracts\Project')
@inject('reviewRepo', 'App\Repos\ReviewRepo')
{{-- */
    $isLocked = $reviewRepo->isLocked('construction_daily', $constructionDaily->id);
/* --}}

{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    trans('all.external') => route('projects.external.index', $project->id),
    trans('all.p_construction_daily') => route('projects.construction-dailies.index', $project->id),
    trans('all.construction_daily') => null
] /* --}}

@extends('layouts.project')

@section('content')

    <div class="sixteen wide column">
        <review-btns
            project-id="{{ $project->id }}"
            resource-type="construction_daily"
            resource-id="{{ $constructionDaily->id }}"
        ></review-btns>
    </div>

    <br>

    <construction-daily project-id="{{ $project->id }}" date="{{ $date }}" is-locked="{{ $isLocked }}"></construction-daily>

@stop
