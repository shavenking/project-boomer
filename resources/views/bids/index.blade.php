{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    trans('all.bid') => null
] /* --}}

@extends('layouts.project')

@section('content')

    <div class="ui secondary pointing menu">
        <a href="{{ route('projects.bid.index', $project->id) }}" class="active item">{{ trans('all.bid') }}</a>
        <a href="{{ route('projects.bid.works', $project->id) }}" class="item">{{ trans_choice('all.works', 2) }}</a>
    </div>

    <p>{{ trans('all.bid') }}</p>
@stop
