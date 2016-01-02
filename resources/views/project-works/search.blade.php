{{-- */ $breadcrumbs = [
    'Projects' => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    'Internal' => route('projects.internal', $project->id),
    'Bid' => route('projects.bid.index', $project->id),
    'Works' => route('projects.bid.works', $project->id),
    'Search' => null
] /* --}}

@extends('layouts.project')

@section('sidebar')
    @include('partials.internal-sidebar')
@stop

@section('content')

    <div class="ui raised segment">
        <form method="GET" action="{{ route('projects.bid.works', $project->id)}}" class="ui inline form">
            <div id="flowtype-select"></div>

            <button class="ui primary button" type="submit">Search</button>
        </form>
    </div>
@stop

