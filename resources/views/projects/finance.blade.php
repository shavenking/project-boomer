{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    trans('all.finance') => null
] /* --}}

@extends('layouts.project')

@section('content')

    <p>{{ trans('all.finance') }}</p>

@stop
