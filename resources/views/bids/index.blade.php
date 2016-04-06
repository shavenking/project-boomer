{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    trans('all.bid') => null
] /* --}}

@extends('layouts.project')

@section('content')

    <div class="ui secondary pointing menu">
        <a href="{{ route('projects.bid.works', $project->id) }}" class="item">{{ trans('all.create_bid') }}</a>
    </div>

    <p>{{ trans('all.bid') }}</p>
@stop
