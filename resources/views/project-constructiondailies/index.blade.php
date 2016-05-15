{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    trans('all.external') => route('projects.external.index', $project->id),
    trans('all.p_construction_daily') => null
] /* --}}

@extends('layouts.project')

@section('content')

    <a href="{{ route('projects.construction-dailies.show', [$project->id, 'today']) }}" class="ui primary button">
        填寫今日施工日報表
    </a>

    <table class="ui table">
        <thead>
            <tr>
                <th>歷史施工日報表</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datePeriod as $date)
                <tr>
                   <td class="selectable"><a href="{{ route('projects.construction-dailies.show', [$project->id, $date]) }}">{{ $date }}</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
