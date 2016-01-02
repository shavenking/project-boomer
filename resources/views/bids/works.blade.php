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
        <div class="sixteen wide column">
            <a href="{{ route('projects.works.create', [$project->id, 'mainflow_type_id' => request()->query('mainflow_type_id'), 'detailingflow_type_id' => request()->query('detailingflow_type_id')]) }}" class="ui primary labeled icon button">
                <i class="plus icon"></i>新增專案工項
            </a>
            @if (isset($mainflowTypeName) || isset($detailingflowTypeName))
                <div class="ui labeled button" tabindex="0">
                    <a href="{{ route('projects.works.search', [$project->id]) }}" class="ui button">
                        <i class="search icon"></i>Search
                    </a>
                    <a href="{{ route('projects.works.search', [$project->id]) }}" class="ui basic left pointing label">
                        @if (isset($mainflowTypeName))
                            {{ $mainflowTypeName or '' }}
                        @endif

                        @if (isset($mainflowTypeName) && isset($detailingflowTypeName))
                            &nbsp;-&nbsp;
                        @endif

                        @if (isset($detailingflowTypeName))
                            {{ $detailingflowTypeName }}
                        @endif
                    </a>
                </div>
            @else
                <a href="{{ route('projects.works.search', [$project->id]) }}" class="ui button">
                    <i class="search icon"></i>Search
                </a>
            @endif
        </div>
        @if (!$works->isEmpty())
            @foreach ($works as $work)
                <div class="eight wide column">
                    @include('components.work')
                </div>
            @endforeach
        @endif
    </div>
@stop
