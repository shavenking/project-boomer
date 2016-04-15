{{-- */ $breadcrumbs = [
    trans('all.settings') => route('settings.index'),
    trans_choice('all.works', 2) => route('works.index'),
    "{$work->name}" => route('works.show', $work->id),
    trans('all.unit_price_analysis') => null
] /* --}}

@extends('layouts.settings')

@section('content')


    <workitem-list
        work-id="{{ $work->id }}"
    ></workitem-list>

@stop
