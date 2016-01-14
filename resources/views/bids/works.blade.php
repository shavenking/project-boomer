{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    trans('all.bid') => route('projects.bid.index', $project->id),
    trans('all.works') => null
] /* --}}

@extends('layouts.project')

@section('content')

    <div class="ui secondary pointing menu">
        <a href="{{ route('projects.bid.index', $project->id) }}" class="item">{{ trans('all.bid') }}</a>
        <a href="{{ route('projects.bid.works', $project->id) }}" class="active item">{{ trans_choice('all.works', 2) }}</a>
    </div>

    <div class="ui grid">
        <div class="sixteen wide column">
            <a href="{{ route('projects.works.create', [$project->id, 'mainflow_type_id' => request()->query('mainflow_type_id'), 'detailingflow_type_id' => request()->query('detailingflow_type_id')]) }}" class="ui primary labeled icon button">
                <i class="plus icon"></i>{{ trans('all.create_project_work') }}
            </a>
            @if (isset($mainflowTypeName) || isset($detailingflowTypeName))
                <div class="ui labeled button" tabindex="0">
                    <a href="{{ route('projects.works.search', [$project->id]) }}" class="ui button">
                        <i class="search icon"></i>{{ trans('all.search') }}
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
                    <i class="search icon"></i>{{ trans('all.search') }}
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
