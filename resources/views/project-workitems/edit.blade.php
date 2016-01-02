{{-- */ $breadcrumbs = [
    'Projects' => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    'Internal' => route('projects.internal', $project->id),
    'Bid' => route('projects.bid.index', $project->id),
    'Works' => route('projects.bid.works', $project->id),
    "{$work->name}" => route('projects.works.show', [$project->id, $work->id]),
    'Edit' => null
] /* --}}

@extends('layouts.project')

@section('sidebar')
    @include('partials.internal-sidebar')
@stop

@section('content')

    <div class="ui raised segment">
        <form
            class="ui form"
            action="{{ route('projects.workitems.update', [$project->id, $workitem->id]) }}"
            method="POST"
        >
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="field">
                <label>Name</label>
                <input type="text" name="name" value="{{ $workitem->name }}">
            </div>

            <div class="field">
                <label>Amount</label>
                <input type="text" name="amount" value="{{ $workitem->amount }}">
            </div>

            <div class="field">
                <label>Unit Price</label>
                <input type="text" name="unit_price" value="{{ $workitem->unit_price }}">
            </div>

            <button class="ui primary button">Save</button>
        </form>
    </div>



@stop
