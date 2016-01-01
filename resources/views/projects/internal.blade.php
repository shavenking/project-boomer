{{-- */ $breadcrumbs = [
    'Projects' => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    'Internal' => null
] /* --}}

@extends('layouts.project')

@section('sidebar')
    @include('partials.internal-sidebar')
@stop

@section('content')
    專案： {{ $project->name }} 內部作業
@stop
