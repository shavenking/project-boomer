{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    trans('all.p_bid') => route('projects.bid.works', $project->id),
    trans('all.bids') => null
] /* --}}

@extends('layouts.project')

@section('content')

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
                    <a href="{{ route('projects.bid.works', $project->id) }}" class="ui red left pointing label">
                        <i class="remove icon"></i>{{ trans('all.clear_search') }}
                    </a>
                </div>
            @else
                <a href="{{ route('projects.works.search', [$project->id]) }}" class="ui button">
                    <i class="search icon"></i>{{ trans('all.search') }}
                </a>
            @endif
        </div>
        <div class="sixteen wide column">
            <table-project-works
                project-id="{{ $project->id }}"
                query="{{ json_encode(request()->query()) }}"
                type-order-label="{{ trans('all.type_order') }}"
                name-label="{{ trans('all.name') }}"
                unit-label="{{ trans('all.unit') }}"
                unit-price-label="{{ trans('all.unit_price') }}"
                amount-label="{{ trans('all.amount') }}"
                total-price-label="{{ trans('all.total_price') }}"
                workitems-label="{{ trans_choice('all.workitems', 2) }}"
            ></table-project-works>
        </div>
    </div>
@stop
