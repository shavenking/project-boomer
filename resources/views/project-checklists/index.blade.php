{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    trans_choice('all.checklists', 2) => null
] /* --}}

@extends('layouts.project')

@section('content')

    <p>
        <a href="{{ route('projects.checklists.create', $project->id) }}" class="ui primary button">
            <i class="plus icon"></i>{{ trans('all.create_checklist') }}
        </a>
    </p>

    <div class="ui grid">
        <div class="computer tablet only row">
            <div class="sixteen wide column">
                <table class="ui celled table">
                    <thead>
                        <tr>
                            <th>名稱</th>
                            <th>協力廠商</th>
                            <th>查核狀態</th>
                            <th>缺失狀態</th>
                            <th>完成數量</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($checklists as $checklist)
                            <tr>
                                <td class="selectable">
                                    <a href="{{ route('projects.checklists.show', [$project->id, $checklist->id]) }}">{{ $checklist->name }}</a>
                                </td>
                                <td>{{ $checklist->subcontractor->name }}</td>
                                <td>{{ $checklist->passes ? '查核完成' : '未查核完成'}}</td>
                                <td>{{ $checklist->fales ? '無' : '有'}}</td>
                                <td>{{ $checklist->passes_amount }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mobile only row">
            <div class="sixteen wide column">
                <div class="ui cards">
                    @foreach ($checklists as $checklist)
                    <div class="ui fluid card">
                        <div class="content">
                            <div class="header">

                                <a href="{{ route('projects.checklists.show', [$project->id, $checklist->id]) }}">{{ $checklist->name }}</a>
                            </div>
                            <div class="description">
                                完成數量：{{ $checklist->passes_amount}}
                            </div>
                        </div>

                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


@stop
