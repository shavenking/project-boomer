{{-- */ $breadcrumbs = [
    trans('all.settings') => route('settings.index'),
    trans_choice('all.checklists', 2) => route('checklists.index'),
    "{$checklist->name}" => null
] /* --}}

@extends('layouts.settings')

@section('content')

    <div class="ui secondary pointing menu">
        <a href="{{ route('checklists.show', $checklist->id) }}" class="active item">{{ $checklist->name  }}</a>
        <a href="{{ route('checklists.workflow', $checklist->id) }}" class="item">{{ trans('all.workflows') }}</a>
        <a href="{{ route('checklists.works', $checklist->id) }}" class="item">{{ trans_choice('all.works', 1) }}</a>
    </div>

    <checklist checklist-id="{{ $checklist->id }}" title-label="{{ trans('all.title') }}" detail-label="{{ trans('all.detail') }}"></checklist>
@stop
