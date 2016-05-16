{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    trans_choice('all.fault_improvements', 2) => null
] /* --}}

@extends('layouts.project')

@section('content')

    <div class="ui grid">
        <div class="computer tablet only row">
            <div class="sixteen wide column">
                <table class="ui celled table">
                    <thead>
                        <tr>
                            <th>自主檢查表</th>
                            <th>缺失項目</th>
                        </tr>
                    </thead>
                    <tbody>
                    <ul>
                        @foreach ($checklists as $checklist)
                            <tr>
                                <td class="selectable">
                                    <a href="{{ route('projects.checklists.show', [$project->id, $checklist->id]) }}">{{ $checklist->name }}</a>
                                </td>
                    <ul>
                        @foreach ($checklist->checkitems as $checkitem)
                            @if ($checkitem->faultImprovement)
                                <td >
                                    <a href="{{ route('projects.fault-improvements.show', [$project->id, $checkitem->faultImprovement->id]) }}">{{ $checkitem->name }} - {{ $checkitem->detail }}</a>
                                </td>
                            </tr>
                            @endif
                        @endforeach
                    </ul>
                        @endforeach
                    </ul>
                   </tbody>
                </table>
            </div>
        </div>
    </div>



@stop
