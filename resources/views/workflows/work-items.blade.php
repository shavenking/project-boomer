{{-- */ $breadcrumbs = [
    trans('all.settings') => route('settings.index'),
    trans_choice('all.workflows', 2) => route('workflows.index'),
    "{$workflow->name}" => route('workflows.show', $workflow->id),
    "{$work->name}" => route('works.show', $work->id),
    trans('all.unit_price_analysis') => null
] /* --}}

@extends('layouts.settings')

@section('content')


    <workitem-list
        work-id="{{ $work->id }}"
    ></workitem-list>

@stop
