{{-- */ $breadcrumbs = [
    'Settings' => route('settings.index'),
    'Workflows' => route('workflows.index'),
    "{$workflow->name}" => null
] /* --}}

@extends('layouts.settings')

@section('content')

    <div class="ui secondary pointing menu">
        <a href="{{ route('workflows.show', $workflow->id) }}" class="active item">流程圖</a>
        <a href="{{ route('workflows.works', $workflow->id) }}" class="item">工作項目列表</a>
        <a href="{{ route('workflows.checklist', $workflow->id) }}" class="item">Check List</a>
    </div>

    <div id="workflow-node-list" data-workflow-id="{{ $workflow->id }}"><!-- React Component --></div>

@stop
