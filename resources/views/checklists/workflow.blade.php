{{-- */ $breadcrumbs = [
    'Settings' => route('settings.index'),
    'Checklists' => route('checklists.index'),
    "{$checklist->name}" => null
] /* --}}

@extends('layouts.settings')

@section('content')

    <div class="ui secondary pointing menu">
        <a href="{{ route('checklists.show', $checklist->id) }}" class="item">{{ $checklist->name }}</a>
        <a href="{{ route('checklists.workflow', $checklist->id) }}" class="active item">Workflow</a>
        <a href="{{ route('checklists.works', $checklist->id) }}" class="item">Works</a>
    </div>

    <div id="workflow-node-list" data-workflow-id="{{ $checklist->workflow->id }}"><!-- React Component --></div>
@stop
