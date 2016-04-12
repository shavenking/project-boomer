{{-- */ $breadcrumbs = [
    trans('all.settings') => route('settings.index'),
    trans_choice('all.works', 2) => route('works.index'),
    "{$work->name}" => route('works.show', $work->id),
    trans('all.workflow') => null
] /* --}}

@extends('layouts.settings')

@section('content')
    <div class="ui secondary pointing menu">
        <a href="{{ route('works.show', $work->id) }}" class="item">{{ trans('all.work') }}</a>
        <a href="{{ route('works.workflow', $work->id) }}" class="active item">{{ trans('all.workflow') }}</a>
    </div>

    <workflow-nodes
        label-text="{{ trans('all.create_node') }}"
        workflow-id="{{ $work->workflow->id }}"
    ></workflow-nodes>
@stop
