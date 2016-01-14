{{-- */ $breadcrumbs = [
    'Projects' => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    'Bid' => null
] /* --}}

@extends('layouts.project')

@section('content')

    <div class="ui secondary pointing menu">
        <a href="{{ route('projects.bid.index', $project->id) }}" class="active item">基本資料</a>
        <a href="{{ route('projects.bid.works', $project->id) }}" class="item">工作項目列表</a>
    </div>

    <p>基本資料</p>
@stop
