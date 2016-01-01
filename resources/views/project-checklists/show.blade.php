{{-- */ $breadcrumbs = [
    'Projects' => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    'External' => route('projects.external', $project->id),
    'Checklists' => route('projects.checklists.index', $project->id),
    "{$checklist->name}" => null
] /* --}}

@extends('layouts.project')

@section('sidebar')
    @include('partials.external-sidebar')
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
