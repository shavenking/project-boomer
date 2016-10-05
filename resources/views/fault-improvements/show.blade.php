@inject('projectRepo', 'App\Repos\Contracts\Project')
@inject('reviewRepo', 'App\Repos\ReviewRepo')
{{-- */
    $constructionDaily = $checklist->projectWork->constructionDailies()->wherePivot('seat', $checklist->seat)->first();

    $isLocked = $reviewRepo->isLocked('fault_improvement', $faultImprovement->id)
        || $reviewRepo->isLocked('project_checklist', $checklist->id)
        || ($constructionDaily && $reviewRepo->isLocked('construction_daily', $constructionDaily->id));
/* --}}

{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    trans('all.external') => route('projects.external.index', $project->id),
    trans_choice('all.checklists', 2) => route('projects.checklists.index', $project->id),
    "{$checklist->name}" => route('projects.checklists.show', [$project->id, $checklist->id]),
    trans_choice('all.fault_improvements', 1) => null
] /* --}}

@extends('layouts.project')

@section('content')

    <div class="sixteen wide column">
        <review-btns
            project-id="{{ $project->id }}"
            resource-type="fault_improvement"
            resource-id="{{ $faultImprovement->id }}"
        ></review-btns>
    </div>

<h3 class="ui header">自主檢查表：{{ $faultImprovement->checkitem->checklist->name }}</h3>
<h4 class="ui header">缺失項目：{{ $faultImprovement->checkitem->name }} - {{$faultImprovement->checkitem->detail }}</h4>





    <div class="ui one column grid">
        <div class="column">
            <card-fault-improvement-photo
                    project-id="{{ $project->id }}"
                    serialized-fault-improvement="{{ $faultImprovement }}"
                    step="before"
                    header="{{ trans('all.before_photo') }}"
                    is-locked="{{ $isLocked }}"
            ></card-fault-improvement-photo>
        </div>

        <div class="column">
            <card-fault-improvement-photo
                    project-id="{{ $project->id }}"
                    serialized-fault-improvement="{{ $faultImprovement }}"
                    step="current"
                    header="{{ trans('all.current_photo') }}"
                    is-locked="{{ $isLocked }}"
            ></card-fault-improvement-photo>
        </div>

        <div class="column">
            <card-fault-improvement-photo
                project-id="{{ $project->id }}"
                serialized-fault-improvement="{{ $faultImprovement }}"
                step="after"
                header="{{ trans('all.after_photo') }}"
                is-locked="{{ $isLocked }}"
            ></card-fault-improvement-photo>
        </div>
        <div class="column">
            <buttons-fault-improvement-result
                project-id="{{ $project->id }}"
                serialized-fault-improvement="{{ $faultImprovement }}"
                is-locked="{{ $isLocked }}"
            ></buttons-fault-improvement-result>
        </div>
        <div class="column">
            <a href="{{ route('projects.fault-improvements.index', $project->id) }}" class="ui primary button">返回工程施工改善</a>
        </div>
    </div>
@stop
