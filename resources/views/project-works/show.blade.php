{{-- */ $breadcrumbs = [
    'Projects' => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    'Internal' => route('projects.internal', $project->id),
    'Bid' => route('projects.bid.index', $project->id),
    'Works' => route('projects.bid.works', $project->id),
    "{$work->name}" => null
] /* --}}

@extends('layouts.project')

@section('sidebar')
    @include('partials.internal-sidebar')
@stop

@section('content')

    <div class="ui raised segment">
        <ol>
            @foreach ($work->workitems as $workitem)
                <li>{{ $workitem->name }}</li>
            @endforeach
        </ol>
    </div>

@stop
