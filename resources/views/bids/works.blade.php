{{-- */ $breadcrumbs = [
    'Projects' => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    'Internal' => route('projects.internal', $project->id),
    'Bid' => route('projects.bid.index', $project->id),
    'Works' => null
] /* --}}

@extends('layouts.project')

@section('sidebar')
    @include('partials.internal-sidebar')
@stop

@section('content')

    <div class="ui secondary pointing menu">
        <a href="{{ route('projects.bid.index', $project->id) }}" class="item">基本資料</a>
        <a href="{{ route('projects.bid.works', $project->id) }}" class="active item">工作項目列表</a>
    </div>

    <div class="ui grid">
        @if ($works->isEmpty())
            <div class="sixteen wide column">
                @include('messages.empty', [
                    'header' => '暫時沒有專案工項',
                    'url' => route('projects.works.create', $project->id)
                ])
            </div>
        @else
            <div class="sixteen wide column">
                <a href="{{ route('projects.works.create', [$project->id]) }}" class="ui primary labeled icon button">
                    <i class="plus icon"></i>新增專案工項
                </a>
            </div>

            @foreach ($works as $work)
                <div class="eight wide column">
                    @include('components.work')
                </div>
            @endforeach
        @endif
    </div>
@stop
