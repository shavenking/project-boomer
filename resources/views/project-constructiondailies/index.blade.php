{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    trans_choice('all.fault_improvements', 2) => null
] /* --}}

@extends('layouts.project')

@section('content')

    <a href=# class="ui primary button">
        <i class="plus icon"></i>{{ trans('all.create_constructiondaily') }}
    </a>
    <div class="ui raised segment">
    </div>
@stop
