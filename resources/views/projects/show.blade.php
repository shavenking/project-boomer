{{-- */ $breadcrumbs = [
    'Projects' => route('projects.index'),
    "{$project->name}" => null
] /* --}}

@extends('layouts.project')

@section('content')
    專案： {{ $project->name }} 首頁
@stop
