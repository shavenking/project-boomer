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

    <div class="ui grid">

        <div class="sixteen wide column">
            <a
                href="{{ route('projects.works.workitems.create', [$project->id, $work->id]) }}"
                class="ui primary button"
            >
                <i class="plus icon"></i>
                Create Workitem
            </a>
        </div>

        @foreach ($work->workitems->sortBy('order') as $workitem)
            <div class="eight wide column">
                @include('components.workitem')
            </div>
        @endforeach

    </div>



@stop
