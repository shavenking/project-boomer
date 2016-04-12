{{-- */ $breadcrumbs = [
    trans('all.settings') => route('settings.index'),
    trans_choice('all.works', 2) => route('works.index'),
    "{$work->name}" => route('works.show', $work->id),
    trans('all.unit_price_analysis') => null
] /* --}}

@extends('layouts.settings')

@section('content')
    <div class="ui secondary pointing menu">
        <a href="{{ route('works.show', $work->id) }}" class="item">{{ trans('all.work') }}</a>
        <a href="{{ route('works.work-items.index', $work->id) }}" class="active item">{{ trans('all.unit_price_analysis') }}</a>
    </div>

    <workitem-list
        work-id="{{ $work->id }}"
    ></workitem-list>

@stop
