{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    trans('all.finance') => route('projects.finance.index', $project->id),
    '工程進度估驗計價' => route('projects.cost-estimations.index', $project->id),
    "估驗計價單（ {$date->toDateString()} ）" => null
] /* --}}

@extends('layouts.project')

@section('content')

    <cost-estimation-sheet project-id="{{ $project->id }}" date="{{ $date->toDateString() }}"></cost-estimation-sheet>

    <form action="{{ route('projects.cost-estimations.store', $project->id) }}" method="POST" class="ui form">
        {{ csrf_field() }}
        <input type="hidden" name="date" value="{{ $date->toDateString() }}">
        <button type="submit" class="ui primary button">確定新增估驗計價單</button>
    </form>

@stop
