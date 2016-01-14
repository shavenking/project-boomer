{{-- */ $breadcrumbs = [
    'Projects' => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    'Checklists' => route('projects.checklists.index', $project->id),
    "{$checklist->name}" => route('projects.checklists.show', [$project->id, $checklist->id]),
    'Fault Improvement' => null
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
                                <label>Before Photo</label>
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
                                <label>Current Photo</label>
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
                                <label>After Photo</label>
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
                    <button class="ui primary button" type="submit">Save</button>
                </div>
            </div>

        </form>


    </div>
@stop
