{{-- */ $breadcrumbs = [
    trans('all.settings') => route('settings.index'),
    trans_choice('all.workflows', 2) => route('workflows.index'),
    "{$workflow->name}" => null
] /* --}}

@extends('layouts.settings')

@section('content')

    <div class="ui secondary pointing menu">
        <a href="{{ route('workflows.show', $workflow->id) }}" class="active item">{{ trans_choice('all.workflows', 1) }}</a>
        <a href="{{ route('workflows.works', $workflow->id) }}" class="item">{{ trans_choice('all.works', 2) }}</a>
        <a href="{{ route('workflows.checklist', $workflow->id) }}" class="item">{{ trans_choice('all.checklists', 1) }}</a>
    </div>

    <div class="ui raised segment">
        <workflow-nodes label-text="{{ trans('all.create_node') }}" workflow-id="{{ $workflow->id }}"></workflow-nodes>
    </div>

@stop
