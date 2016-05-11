{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    trans('all.finance') => route('projects.finance.index', $project->id),
    '工程進度估驗計價' => null
] /* --}}

@extends('layouts.project')

@section('content')
    <table class="ui table">
        <thead>
            <tr>
                <th>估驗計價單</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="selectable">
                    <a href="{{ route('projects.cost-estimations.show', [$project->id, 'today']) }}">今日（ {{ $today->toDateString() }} ）</a>
                </td>
            </tr>
            @foreach ($datePeriod as $date)
                <tr>
                   <td class="selectable"><a href="{{ route('projects.cost-estimations.show', [$project->id, $date]) }}">{{ $date }}</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
