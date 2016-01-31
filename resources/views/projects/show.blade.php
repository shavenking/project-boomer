{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => null
] /* --}}

@extends('layouts.project-nosidebar')

@section('content')
    {{ trans_choice('all.projects', 1) }}: {{ $project->name }}
@stop
