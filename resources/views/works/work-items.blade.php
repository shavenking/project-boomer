{{-- */ $breadcrumbs = [
    trans('all.settings') => route('settings.index'),
    trans_choice('all.works', 2) => route('works.index'),
    "{$work->name}" => route('works.show', $work->id),
    trans_choice('all.workitems', 2) => null
] /* --}}

@extends('layouts.settings')

@section('content')
    <div class="ui secondary pointing menu">
        <a href="{{ route('works.show', $work->id) }}" class="item">{{ trans_choice('all.works', 1) }}</a>
        <a href="{{ route('works.work-items.index', $work->id) }}" class="active item">{{ trans_choice('all.workitems', 2) }}</a>
        <a href="{{ route('works.workflow', $work->id) }}" class="item">{{ trans_choice('all.workflows', 1) }}</a>
        <a href="{{ route('works.checklist', $work->id) }}" class="item">{{ trans_choice('all.checklists', 1) }}</a>
    </div>

    <div class="ui raised segment">
        <statistics-workitems 
            work-id="{{ $work->id }}"
            total-price-label="{{ trans('all.total_price') }}"
        ></statistics-workitems>
    </div>

    <table-workitems 
        work-id="{{ $work->id }}"
        cost-type-label="{{ trans('all.type') }}"
        unit-label="{{ trans('all.unit') }}"
        name-label="{{ trans('all.name') }}"
        amount-label="{{ trans('all.amount') }}"
        unit-price-label="{{ trans('all.unit_price') }}"
        total-price-label="{{ trans('all.total_price') }}"
    ></table-workitems>
@stop
