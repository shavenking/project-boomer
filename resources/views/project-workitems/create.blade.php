{{-- */ $breadcrumbs = [
    'Projects' => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    'Bid' => route('projects.bid.index', $project->id),
    'Works' => route('projects.bid.works', $project->id),
    "{$work->name}" => route('projects.works.show', [$project->id, $work->id]),
    'Create Workitem' => null
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
                <label>Name</label>
                <input type="text" name="name">
            </div>

            <div class="field">
                <label>Amount</label>
                <input type="text" name="amount">
            </div>

            <div class="field">
                <label>Unit Price</label>
                <input type="text" name="unit_price">
            </div>

            <div class="field">
                <label>Unit</label>
                <select class="ui dropdown" name="unit_id">
                    @foreach ($units as $unit)
                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="field">
                <label>Types</label>
                <select class="ui dropdown" name="cost_type_id">
                    @foreach ($costTypes as $costType)
                        <option value="{{ $costType->id }}">{{ $costType->name }}</option>
                    @endforeach
                </select>
            </div>

            <button class="ui primary button" type="submit">Create</button>
        </form>
    </div>

@stop
