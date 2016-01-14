{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    trans('all.bid') => route('projects.bid.index', $project->id),
    trans_choice('all.works', 2) => route('projects.bid.works', $project->id),
    "{$work->name}" => route('projects.works.show', [$project->id, $work->id]),
    trans('all.create_workitem') => null
] /* --}}

@extends('layouts.project')

@section('content')

    <div class="ui raised segment">
        <form
            method="POST"
            action="{{ route('projects.works.workitems.store', [$project->id, $work->id])}}"
            class="ui form"
        >
            {{ csrf_field() }}

            <div class="field">
                <label>{{ trans('all.name') }}</label>
                <input type="text" name="name">
            </div>

            <div class="field">
                <label>{{ trans('all.amount') }}</label>
                <input type="text" name="amount">
            </div>

            <div class="field">
                <label>{{ trans('all.unit_price') }}</label>
                <input type="text" name="unit_price">
            </div>

            <div class="field">
                <label>{{ trans('all.unit') }}</label>
                <select class="ui dropdown" name="unit_id">
                    @foreach ($units as $unit)
                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="field">
                <label>{{ trans('all.type') }}</label>
                <select class="ui dropdown" name="cost_type_id">
                    @foreach ($costTypes as $costType)
                        <option value="{{ $costType->id }}">{{ $costType->name }}</option>
                    @endforeach
                </select>
            </div>

            <button class="ui primary button" type="submit">{{ trans('all.create') }}</button>
        </form>
    </div>

@stop
