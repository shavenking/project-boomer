@extends('layouts.project')

@section('title')
    Projects | {{ $project->name }} | External | Checklists | {{ $checklist->name }}
@stop

@section('sidebar')
    @include('partials.external-sidebar')
@stop

@section('breadcrumbs')
    <a href="{{ route('projects.index') }}" class="section">Projects</a>

    <i class="right chevron icon divider"></i>

    <a href="{{ route('projects.show', $project->id) }}" class="section">{{ $project->name }}</a>

    <i class="right chevron icon divider"></i>

    <a href="{{ route('projects.external', $project->id) }}" class="section">External</a>

    <i class="right chevron icon divider"></i>

    <a href="{{ route('projects.checklists.index', $project->id) }}" class="section">Checklists</a>

    <i class="right chevron icon divider"></i>

    <div class="active section">{{ $checklist->name }}</div>
@stop

@section('content')

    @if ($checklist->checkitems->isEmpty())
        You didn't create any checkitem yet.
    @else
        <div class="ui clearing raised segment">
            <form class="ui form" action="{{ route('projects.checklists.checkresults.update', [$project->id, $checklist->id])}}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="ui middle aligned divided items">
                    @foreach ($checklist->checkitems as $checkitem)
                        @include('project-checklists._checkitem', compact('checkitem'))
                    @endforeach
                </div>

                <button class="ui right floated primary button" type="submit">Save</button>
            </form>
        </div>
    @endif
@stop
