{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    trans_choice('all.checklists', 2) => route('projects.checklists.index', $project->id),
    "{$checklist->name}" => route('projects.checklists.show', [$project->id, $checklist->id]),
    trans_choice('all.fault_improvements', 1) => null
] /* --}}

@extends('layouts.project')

@section('content')
        <form
            method="POST"
            action="{{ route('projects.fault-improvements.update', [$project->id, $faultImprovement->id]) }}"
            class="ui form"
            enctype="multipart/form-data"
        >
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="ui one column grid">
                <div class="column">
                    <div class="ui fluid card">
                        <div class="content">
                            <div class="header">{{ trans('all.before_photo') }}</div>
                        </div>
                        @if ($faultImprovement->before_photo)
                            <div class="image">
                                <img src="/images/{{ $faultImprovement->before_photo }}" alt="before_photo">
                            </div>
                        @endif
                        <div class="content">
                            <div class="field">
                                <input type="file" name="before_photo">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="column">
                    <div class="ui fluid card">
                        <div class="content">
                            <div class="header">{{ trans('all.current_photo') }}</div>
                        </div>
                        @if ($faultImprovement->current_photo)
                            <div class="image">
                                <img src="/images/{{ $faultImprovement->current_photo }}" alt="current_photo">
                            </div>
                        @endif
                        <div class="content">
                            <div class="field">
                                <input type="file" name="current_photo">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="column">
                    <div class="ui fluid card">
                        <div class="content">
                            <div class="header">{{ trans('all.after_photo') }}</div>
                        </div>
                        @if ($faultImprovement->after_photo)
                            <div class="image">
                                <img src="/images/{{ $faultImprovement->after_photo }}" alt="after_photo">
                            </div>
                        @endif
                        <div class="content">
                            <div class="field">
                                <input type="file" name="after_photo">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ui one column grid">
                <div class="column">
                    @include('components.fault-improvement-radio-buttons', compact('faultImprovement'))
                </div>
                <div class="column">
                    <button class="ui primary button" type="submit">{{ trans('all.save') }}</button>
                    <a href="{{ route('projects.fault-improvements.index', $project->id) }}" class="ui primary button">返回工程施工改善</a>
                </div>
            </div>
        </form>
@stop
