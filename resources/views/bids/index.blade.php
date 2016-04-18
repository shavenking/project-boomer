{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    trans('all.bid') => null
] /* --}}

@extends('layouts.project')

@section('content')


    <p>{{ trans('all.bid') }}</p>
@stop
