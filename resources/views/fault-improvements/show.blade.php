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

    <div class="ui one column grid">
        <div class="column">
            <card-fault-improvement-photo
                    project-id="{{ $project->id }}"
                    serialized-fault-improvement="{{ $faultImprovement }}"
                    step="before"
                    header="{{ trans('all.before_photo') }}"
            ></card-fault-improvement-photo>
        </div>

        <div class="column">
            <card-fault-improvement-photo
                    project-id="{{ $project->id }}"
                    serialized-fault-improvement="{{ $faultImprovement }}"
                    step="current"
                    header="{{ trans('all.current_photo') }}"
            ></card-fault-improvement-photo>
        </div>

        <div class="column">
            <card-fault-improvement-photo
                project-id="{{ $project->id }}"
                serialized-fault-improvement="{{ $faultImprovement }}"
                step="after"
                header="{{ trans('all.after_photo') }}"
            ></card-fault-improvement-photo>
        </div>
        <div class="column">
            <buttons-fault-improvement-result
                project-id="{{ $project->id }}"
                serialized-fault-improvement="{{ $faultImprovement }}"
            ></buttons-fault-improvement-result>
        </div>
        <div class="column">
            <a href="{{ route('projects.fault-improvements.index', $project->id) }}" class="ui primary button">返回工程施工改善</a>
        </div>
    </div>
@stop
