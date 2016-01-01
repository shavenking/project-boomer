{{-- */ $breadcrumbs = [
    'Projects' => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    'Internal' => route('projects.internal', $project->id),
    'Bid' => route('projects.bid.index', $project->id),
    'Works' => null
] /* --}}

@extends('layouts.project')

@section('sidebar')
    <a href="{{ route('projects.bid.index', $project->id) }}" class="active item">
        標單管理
    </a>
@stop

@section('content')

    <div class="ui secondary pointing menu">
        <a href="{{ route('projects.bid.index', $project->id) }}" class="item">基本資料</a>
        <a href="{{ route('projects.bid.works', $project->id) }}" class="active item">工作項目列表</a>
    </div>

    @if ($works->isEmpty())
        @include('messages.empty', ['header' => '暫時沒有專案工項', 'url' => route('projects.works.create', $project->id) ])
    @else
        @include('components.project-work-list', compact('project', 'works'))
    @endif
@stop
