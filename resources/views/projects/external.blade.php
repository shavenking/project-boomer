{{-- */ $breadcrumbs = [
    'Projects' => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    'External' => null
] /* --}}

@extends('layouts.project')

@section('sidebar')
    @include('partials.external-sidebar')
@stop

@section('content')
    External
@stop
