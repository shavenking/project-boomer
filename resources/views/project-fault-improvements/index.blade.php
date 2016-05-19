{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    trans('all.external') => route('projects.external.index', $project->id),
    trans('all.fault_improvements') => null
] /* --}}

@extends('layouts.project')

@section('content')

    <div class="ui grid">
        <div class="row">
            <div class="sixteen wide mobile only column">
                <div class="ui cards">
                    @foreach ($checklists as $checklist)
                        @foreach ($checklist->checkitems as $checkitem)
                            <div class="ui fluid card">
                                <div class="content">
                                    <div class="header">
                                        自主檢查表：<a href="{{ route('projects.checklists.show', [$project->id, $checklist->id]) }}">{{ $checklist->name }}</a>
                                    </div>
                                    <div class="description">
                                        <a href="{{ route('projects.fault-improvements.show', [$project->id, $checkitem->faultImprovement->id]) }}">{{ $checkitem->name }}</a>
                                    </div>
                                </div>
                                <div class="extra content">
                                    @if (true === $checkitem->faultImprovement->passes)
                                        <span class="ui green label">已改善</span>
                                    @elseif (false === $checkitem->faultImprovement->passes)
                                        <span class="ui red label">有缺失</span>
                                    @else
                                        <span class="ui label">未審核</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
            <div class="sixteen wide computer only column">
                <table class="ui celled structured table">
                    <thead>
                        <tr>
                            <th>自主檢查表</th>
                            <th>缺失項目</th>
                            <th>改善狀態</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($checklists as $checklist)
                            <tr>
                                <td rowspan="{{ $checklist->checkitems->count() }}" class="selectable" >
                                    <a href="{{ route('projects.checklists.show', [$project->id, $checklist->id]) }}">{{ $checklist->name }}</a>
                                </td>
                                <td class="selectable">
                                    <a href="{{ route('projects.fault-improvements.show', [$project->id, $checklist->checkitems->first()->faultImprovement->id]) }}">{{ $checklist->checkitems->first()->name }} - {{ $checklist->checkitems->first()->detail }}</a>
                                </td>
                                @if (true === $checklist->checkitems->first()->faultImprovement->passes)
                                    <td>已改善</td>
                                @elseif (false === $checklist->checkitems->first()->faultImprovement->passes)
                                    <td>有缺失</td>
                                @else
                                    <td>未審核</td>
                                @endif
                            </tr>
                            @foreach ($checklist->checkitems->slice(1) as $checkitem)
                                <tr>
                                    <td class="selectable">
                                        <a href="{{ route('projects.fault-improvements.show', [$project->id, $checkitem->faultImprovement->id]) }}">{{ $checkitem->name }} - {{ $checkitem->detail }}</a>
                                    </td>
                                    @if (true === $checkitem->faultImprovement->passes)
                                        <td>已改善</td>
                                    @elseif (false === $checkitem->faultImprovement->passes)
                                        <td>有缺失</td>
                                    @else
                                        <td>未審核</td>
                                    @endif
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



@stop
