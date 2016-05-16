{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    trans_choice('all.fault_improvements', 2) => null
] /* --}}

@extends('layouts.project')

@section('content')

    <div class="ui grid">
        <div class="row">
            <div class="sixteen wide column">
                <table class="ui celled structured table">
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
                                <td rowspan="{{ $checklist->checkitems->count() }}">
                                    <a href="{{ route('projects.checklists.show', [$project->id, $checklist->id]) }}">{{ $checklist->name }}</a>
                                </td>
                                <td>
                                    <a href="{{ route('projects.fault-improvements.show', [$project->id, $checklist->checkitems->first()->faultImprovement->id]) }}">{{ $checklist->checkitems->first()->name }} - {{ $checklist->checkitems->first()->detail }}</a>
                                </td>
                            </tr>
                            @foreach ($checklist->checkitems->slice(1) as $checkitem)
                                <tr>
                                    <td>
                                        <a href="{{ route('projects.fault-improvements.show', [$project->id, $checkitem->faultImprovement->id]) }}">{{ $checkitem->name }} - {{ $checkitem->detail }}</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



@stop
