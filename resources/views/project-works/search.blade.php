{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    trans('all.bid') => route('projects.bid.index', $project->id),
    trans_choice('all.works', 2) => route('projects.bid.works', $project->id),
    trans('all.search') => null
] /* --}}

@extends('layouts.project')

@section('content')

    <div class="ui raised segment">
        <form method="GET" action="{{ route('projects.bid.works', $project->id)}}" class="ui inline form">
            <div id="flowtype-select"></div>

            <button class="ui primary button" type="submit">{{ trans('all.search') }}</button>
        </form>
    </div>
@stop

