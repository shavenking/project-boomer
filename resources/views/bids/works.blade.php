@inject('projectRepo', 'App\Repos\Contracts\Project')
@inject('reviewRepo', 'App\Repos\ReviewRepo');
{{-- */
    $isLocked = $reviewRepo->isLocked('bid', $project->id);
/* --}}

{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    trans('all.internal') => route('projects.internal.index', $project->id),
    trans('all.p_bid') => null
] /* --}}

@extends('layouts.project')

@section('content')

    <h3>標單</h3>

    <div class="ui grid">
        <div class="sixteen wide column">
            <a href="{{ route('projects.works.create', [$project->id, 'mainflow_type_id' => request()->query('mainflow_type_id'), 'detailingflow_type_id' => request()->query('detailingflow_type_id')]) }}" class="ui primary labeled icon button">
                <i class="plus icon"></i>{{ trans('all.create_work') }}
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

            <a href="{{ route('projects.bid.pdf', $project->id) }}" class="ui button">輸出報表（ PDF ）</a>
        </div>
        <div class="sixteen wide column">
            <review-btns
                project-id="{{ $project->id }}"
                resource-type="bid"
                resource-id="{{ $project->id }}"
            ></review-btns>
        </div>
        <div class="sixteen wide column">
            <table-project-works
                project-id="{{ $project->id }}"
                query="{{ json_encode(request()->query()) }}"
                type-order-label="{{ trans('all.type_order') }}"
                name-label="{{ trans('all.work') }}"
                unit-label="{{ trans('all.unit') }}"
                unit-price-label="{{ trans('all.unit_price') }}"
                amount-label="{{ trans('all.amount') }}"
                total-price-label="{{ trans('all.total_price') }}"
                workitems-label="{{ trans('all.workitems') }}"
                is-locked="{{ $isLocked }}"
            ></table-project-works>
        </div>
    </div>
@stop
