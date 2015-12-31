@extends('layouts.general')

@section('title')
    Settings | Check Lists | {{ $checklist->name }}
@stop

@section('sidebar')
    @include('partials.settings-sidebar')
@stop

@section('breadcrumbs')
    <a href="{{ route('settings.index') }}" class="section">Settings</a>

    <i class="right chevron icon divider"></i>

    <a href="{{ route('checklists.index') }}" class="section">Check Lists</a>

    <i class="right chevron icon divider"></i>

    <div class="active section">{{ $checklist->name }}</div>
@stop

@section('content')

    <div class="ui secondary pointing menu">
        <a href="{{ route('checklists.show', $checklist->id) }}" class="item">{{ $checklist->name }}</a>
        <a href="{{ route('checklists.workflow', $checklist->id) }}" class="active item">Workflow</a>
    </div>

    <div id="workflow-node-list" data-workflow-id="{{ $checklist->workflow->id }}"><!-- React Component --></div>
@stop
