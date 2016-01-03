{{-- */ $breadcrumbs = [
    'Settings' => route('settings.index'),
    'Checklists' => null
] /* --}}

@extends('layouts.general')

@section('sidebar')
    @include('partials.settings-sidebar')
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