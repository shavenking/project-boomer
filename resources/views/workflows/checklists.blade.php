{{-- */ $breadcrumbs = [
    trans('all.settings') => route('settings.index'),
    trans_choice('all.workflows', 2) => route('workflows.index'),
    "{$workflow->name}" => route('workflows.show', $workflow->id),
    trans('all.set_checklists') => null
] /* --}}

@extends('layouts.settings')

@section('content')

    <div class="ui secondary pointing menu">
        <a href="{{ route('workflows.show', $workflow->id) }}" class="item">{{ trans('all.workflow') }}</a>
        <a href="{{ route('workflows.checklist', $workflow->id) }}" class="active item">{{ trans('all.set_checklists') }}</a>
    </div>

    <checklist checklist-id="{{ $checklist->id }}" title-label="{{ trans('all.title') }}" detail-label="{{ trans('all.detail') }}"></checklist>

    <a href="{{ route('workflows.show', $workflow->id) }}" class="ui primary button"><i class="plus icon"></i>{{ trans('all.back_workflows') }}</a>

@stop
