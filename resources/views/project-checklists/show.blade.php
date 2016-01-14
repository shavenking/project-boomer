{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    trans_choice('all.checklists', 2) => route('projects.checklists.index', $project->id),
    "{$checklist->name}" => null
] /* --}}

@extends('layouts.project')

@section('content')

    @if ($checklist->checkitems->isEmpty())
        {{ trans('all.empty_checkitems') }}
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

                <button class="ui right floated primary button" type="submit">{{ trans('all.save') }}</button>
            </form>
        </div>
    @endif
@stop
