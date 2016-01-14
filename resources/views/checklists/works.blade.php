{{-- */ $breadcrumbs = [
    'Settings' => route('settings.index'),
    'Checklists' => route('checklists.index'),
    "{$checklist->name}" => route('checklists.show', $checklist->id),
    'Works' => null
] /* --}}

@extends('layouts.settings')

@section('content')

    <div class="ui secondary pointing menu">
        <a href="{{ route('checklists.show', $checklist->id) }}" class="item">{{ $checklist->name }}</a>
        <a href="{{ route('checklists.workflow', $checklist->id) }}" class="item">Workflow</a>
        <a href="{{ route('checklists.works', $checklist->id) }}" class="active item">Works</a>
    </div>

    @each('works._card', $checklist->workflow->works, 'work')
@stop
