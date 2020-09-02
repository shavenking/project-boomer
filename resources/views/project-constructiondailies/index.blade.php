{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    trans('all.external') => route('projects.external.index', $project->id),
    trans('all.p_construction_daily') => null
] /* --}}

@extends('layouts.project')

@section('content')

    <form action="{{ route('projects.construction-dailies.store', $project->id) }}" method="POST" class="ui inline form">
        {{ csrf_field() }}
        <div class="inline field">
            <label>填寫該日施工日報表</label>
            <input-date name="date"></input-date>
            <input type="submit" class="ui button" value="填寫該日施工日報表">
        </div>
    </form>

    <table class="ui table">
        <thead>
            <tr>
                <th>歷史施工日報表</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($constructionDailies as $constructionDaily)
                <tr>
                   <td class="selectable">
                       <a href="{{ route('projects.construction-dailies.show', [$project->id, $constructionDaily->work_date->toDateString()]) }}">
                           {{ $constructionDaily->work_date->toDateString() }}
                       </a>
                   </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
