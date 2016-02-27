{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    trans('all.p_construction_dailies') => null
] /* --}}

@extends('layouts.project')

@section('content')

    <a href=# class="ui primary button">
        <i class="plus icon"></i>{{ trans('all.create_constructiondaily') }}
    </a>
    <div class="ui raised segment">
    </div>
@stop
