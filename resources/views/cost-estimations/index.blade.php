{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    trans('all.finance') => route('projects.finance.index', $project->id),
    '工程進度估驗計價' => null
] /* --}}

@extends('layouts.project')

@section('content')

    <form action="{{ route('projects.cost-estimations.create', $project->id) }}" method="GET" class="ui inline form">
        <div class="inline field">
            <label>結算日期</label>
            <input type="text" name="date">
            <input type="submit" class="ui button" value="預覽估驗計價單">
        </div>
    </form>

    <table class="ui table">
        <thead>
            <tr>
                <th>估驗計價單</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($costEstimations as $costEstimation)
                <tr>
                   <td class="selectable"><a href="{{ route('projects.cost-estimations.show', [$project->id, $costEstimation->settled_at->toDateString()]) }}">{{ $costEstimation->settled_at->toDateString() }}</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
