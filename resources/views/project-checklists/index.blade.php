{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    trans_choice('all.checklists', 2) => null
] /* --}}

@extends('layouts.project')

@section('content')

    <a href="{{ route('projects.checklists.create', $project->id) }}" class="ui primary button">
        <i class="plus icon"></i>{{ trans('all.create_checklist') }}
    </a>

    <table class="ui celled table">
        <thead>
            <tr>
                <th>名稱</th>
                <th>數量</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($checklists as $checklist)
                <tr>
                    <td class="selectable">
                        <a href="{{ route('projects.checklists.show', [$project->id, $checklist->id]) }}">{{ $checklist->name }}</a>
                    </td>
                    <td>{{ $checklist->passes_amount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

@stop
