{{-- */ $breadcrumbs = [
    'Projects' => route('projects.index'),
    "{$project->name}" => null
] /* --}}

@extends('layouts.project-nosidebar')

@section('content')
    專案： {{ $project->name }} 首頁
@stop
