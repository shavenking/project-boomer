{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    trans('all.bid') => route('projects.bid.index', $project->id),
    trans_choice('all.works', 2) => route('projects.bid.works', $project->id),
    "{$work->name}" => null
] /* --}}

@extends('layouts.project')

@section('content')

    <div class="ui grid">

        <div class="sixteen wide column">
            <a
                href="{{ route('projects.works.workitems.create', [$project->id, $work->id]) }}"
                class="ui primary button"
            >
                <i class="plus icon"></i>
                {{ trans('all.create_workitem') }}
            </a>
        </div>

        @foreach ($work->workitems->sortBy('order') as $workitem)
            <div class="eight wide column">
                @include('components.workitem')
            </div>
        @endforeach

    </div>



@stop
