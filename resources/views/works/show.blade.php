{{-- */ $breadcrumbs = [
    trans('all.settings') => route('settings.index'),
    trans_choice('all.works', 2) => route('works.index'),
    "{$work->name}" => null
] /* --}}

@extends('layouts.settings')

@section('content')

    <div class="ui secondary pointing menu">
        <a href="{{ route('works.show', $work->id) }}" class="active item">{{ trans_choice('all.works', 1) }}</a>
        <a href="{{ route('works.work-items.index', $work->id) }}" class="item">{{ trans_choice('all.workitems', 2) }}</a>
        <a href="{{ route('works.workflow', $work->id) }}" class="item">{{ trans_choice('all.workflows', 1) }}</a>
        <a href="{{ route('works.checklist', $work->id) }}" class="item">{{ trans_choice('all.checklists', 1) }}</a>
    </div>

    @include('works._card', $work)

@stop
