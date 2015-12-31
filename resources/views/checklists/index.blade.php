@extends('layouts.general')

@section('title')
    Settings | Check Lists
@stop

@section('sidebar')
    @include('partials.settings-sidebar')
@stop

@section('breadcrumbs')
    <a href="{{ route('settings.index') }}" class="section">Settings</a>

    <i class="right chevron icon divider"></i>

    <div class="active section">Check Lists</div>
@stop

@section('content')
    <a href="{{ route('checklists.create') }}" class="ui primary button">
        <i class="plus icon"></i> Create New Check List
    </a>

    <div class="ui raised segment">
        <ol class="ui relaxed list">
            @foreach ($checklists as $checklist)
                <li><a href="{{ route('checklists.show', $checklist->id) }}" class="header">{{ $checklist->name }}</a></li>
            @endforeach
        </ol>
    </div>
@stop
