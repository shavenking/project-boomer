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
        <workitem-list
            work-id="{{ $work->id }}"
            edit-text="{{ trans('all.edit') }}"
            delete-text="{{ trans('all.delete') }}"
            amount-text="{{ trans('all.amount') }}"
            unit-price-text="{{ trans('all.unit_price') }}"
        ></workitem-list>
    </div>
@stop
