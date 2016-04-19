{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    trans_choice('all.works', 2) => route('projects.bid.works', $project->id),
    "{$work->name}" => route('projects.works.show', [$project->id, $work->id]),
    trans('all.edit') => null
] /* --}}

@extends('layouts.project')

@section('content')

    <div class="ui raised segment">
        <form
            class="ui form"
            action="{{ route('projects.works.workitems.update', [$project->id, $work, $workitem->id]) }}"
            method="POST"
        >
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="field">
                <label>{{ trans('all.name') }}</label>
                <input type="text" name="name" value="{{ $workitem->name }}">
            </div>

            <div class="field">
                <label>{{ trans('all.amount') }}</label>
                <input type="text" name="amount" value="{{ $workitem->amount }}">
            </div>

            <div class="field">
                <label>{{ trans('all.unit_price') }}</label>
                <input type="text" name="unit_price" value="{{ $workitem->unit_price }}">
            </div>

            <button class="ui primary button">{{ trans('all.save') }}</button>
        </form>
    </div>



@stop
