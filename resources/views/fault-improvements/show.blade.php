{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    trans_choice('all.checklists', 2) => route('projects.checklists.index', $project->id),
    "{$checklist->name}" => route('projects.checklists.show', [$project->id, $checklist->id]),
    trans_choice('all.fault_improvements', 1) => null
] /* --}}

@extends('layouts.project')

@section('content')

    <div class="ui raised segment">
        <form
            method="POST"
            action="{{ route('projects.fault-improvements.update', [$project->id, $faultImprovement->id]) }}"
            class="ui form"
            enctype="multipart/form-data"
        >
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="ui three column grid">
                <div class="column">
                    <div class="ui fluid card">
                        @if ($faultImprovement->before_photo)
                            <a class="image" href="/images/{{ $faultImprovement->before_photo }}">
                                <img src="/images/{{ $faultImprovement->before_photo }}" alt="before_photo">
                            </a>
                        @endif
                        <div class="content">
                            <div class="field">
                                <label>{{ trans('all.before_photo') }}</label>
                                <input type="file" name="before_photo">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="column">
                    <div class="ui fluid card">
                        @if ($faultImprovement->current_photo)
                            <a class="image" href="/images/{{ $faultImprovement->current_photo }}">
                                <img src="/images/{{ $faultImprovement->current_photo }}" alt="current_photo">
                            </a>
                        @endif
                        <div class="content">
                            <div class="field">
                                <label>{{ trans('all.current_photo') }}</label>
                                <input type="file" name="current_photo">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="column">
                    <div class="ui fluid card">
                        @if ($faultImprovement->after_photo)
                            <a class="image" href="/images/{{ $faultImprovement->after_photo }}">
                                <img src="/images/{{ $faultImprovement->after_photo }}" alt="after_photo">
                            </a>
                        @endif
                        <div class="content">
                            <div class="field">
                                <label>{{ trans('all.after_photo') }}</label>
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
                </div>
            </div>

        </form>


    </div>
@stop
