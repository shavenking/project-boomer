{{-- */ $breadcrumbs = [
    trans('all.settings') => route('settings.index'),
    trans_choice('all.works', 2) => route('works.index'),
    "{$work->name}" => route('works.show', $work->id),
    trans_choice('all.workitems', 2) => null
] /* --}}

@extends('layouts.settings')

@section('content')
    <div class="ui secondary pointing menu">
        <a href="{{ route('works.show', $work->id) }}" class="item">{{ trans_choice('all.works', 2) }}</a>
        <a href="{{ route('works.work-items.index', $work->id) }}" class="active item">{{ trans('all.unit_price_analysis') }}</a>
        <a href="{{ route('works.workflow', $work->id) }}" class="item">{{ trans('all.workflow') }}</a>
        <a href="{{ route('works.checklist', $work->id) }}" class="item">{{ trans('all.connect_checklists') }}</a>
    </div>

    <workitem-list
        work-id="{{ $work->id }}"
    ></workitem-list>
@stop
