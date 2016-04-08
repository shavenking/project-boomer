{{-- */ $breadcrumbs = [
    trans('all.settings') => route('settings.index'),
    trans_choice('all.workflows', 2) => route('workflows.index'),
    "{$workflow->name}" => null
] /* --}}

@extends('layouts.settings')

@section('content')

    <div class="ui secondary pointing menu">
        <a href="{{ route('workflows.show', $workflow->id) }}" class="active item">{{ trans('all.workflow') }}</a>
    </div>

    <workflow-nodes label-text="{{ trans('all.create_node') }}" workflow-id="{{ $workflow->id }}"
    button="{{ route('workflows.works', $workflow->id) }}"
    ></workflow-nodes>

@stop
