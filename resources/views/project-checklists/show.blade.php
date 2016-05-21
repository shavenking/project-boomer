{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    trans('all.external') => route('projects.external.index', $project->id),
    trans_choice('all.checklists', 2) => route('projects.checklists.index', $project->id),
    "{$checklist->name}" => null
] /* --}}

@extends('layouts.project')

@section('content')

<h4 class="ui header">協力廠商：{{ $checklist->subcontractor->name }}</h4>

    @if ($checklist->checkitems->isEmpty())
        {{ trans('all.empty_checkitems') }}
    @else
        <div class="ui grid">
            <div class="computer tablet only row">
                <div class="sixteen wide column">
                    <form class="ui form" action="{{ route('projects.checklists.checkresults.update', [$project->id, $checklist->id])}}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <table class="ui celled table">
                            <thead>
                                <tr>
                                    <th>流程檢查項目</th>
                                    <th>檢查標準</th>
                                    <th class="collapsing">缺失改善表</th>
                                    <th>檢查狀態</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($checklist->checkitems as $checkitem)
                                    <tr>
                                        <td class="collapsing">
                                            @if (!is_null($checkitem->passes) && $checkitem->passes)
                                                <i class="green check icon"></i>
                                            @endif
                                            @if (!is_null($checkitem->passes) && !$checkitem->passes)
                                                <i class="red remove icon"></i>
                                            @endif
                                            {{ $checkitem->name }}
                                        </td>
                                        <td>{{ $checkitem->detail }}</td>
                                        <td class="collapsing">
                                            @if (!is_null($checkitem->faultImprovement))
                                                @if (is_null($checkitem->faultImprovement->passes))
                                                    <a
                                                        href="{{ route('projects.fault-improvements.show', [$project->id, $checkitem->faultImprovement->id]) }}"
                                                        class="ui label"
                                                    >
                                                        {{ trans_choice('all.fault_improvements', 1) }}
                                                    </a>
                                                @elseif (!is_null($checkitem->faultImprovement->passes) && $checkitem->faultImprovement->passes)
                                                    <a
                                                        href="{{ route('projects.fault-improvements.show', [$project->id, $checkitem->faultImprovement->id]) }}"
                                                        class="ui green label"
                                                    >
                                                        {{ trans_choice('all.fault_improvements', 1) }}
                                                    </a>
                                                @else
                                                    <a
                                                        href="{{ route('projects.fault-improvements.show', [$project->id, $checkitem->faultImprovement->id]) }}"
                                                        class="ui red label"
                                                    >
                                                        {{ trans_choice('all.fault_improvements', 1) }}
                                                    </a>
                                                @endif
                                            @endif
                                        </td>
                                        <td class="collapsing">
                                            <div class="inline fields">
                                                @include('components.checkitem-radio-buttons', compact('checkitem'))
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                <tfoot>
                                    <th colspan="4" class="right aligned">
                                         <div class="inline field">
                                            <label>完成數量</label>
                                            <input type="text" class="ui fluid" name="passes_amount" value="{{ $checklist->passes_amount }}"></input>
                                            <button class="ui primary button" type="submit">{{ trans('all.save') }}</button>
                                            <a href="{{ route('projects.checklists.index', $project->id) }}" class="ui primary button">返回施工流程自主檢查</a>
                                        </div>

                                    </th>
                                </tfoot>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
            <div class="mobile only row">
                <div class="sixteen wide column">
                    <form class="ui form" action="{{ route('projects.checklists.checkresults.update', [$project->id, $checklist->id])}}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <h4 class="ui dividing header">檢查項目列表</h4>
                        <div class="ui cards">
                            @foreach ($checklist->checkitems as $checkitem)
                                <div class="ui fluid card">
                                    <div class="content">
                                        <div class="header">
                                            @if (!is_null($checkitem->passes) && $checkitem->passes)
                                                <i class="green check icon"></i>
                                            @endif
                                            @if (!is_null($checkitem->passes) && !$checkitem->passes)
                                                <i class="red remove icon"></i>
                                            @endif
                                            {{ $checkitem->name }}
                                        </div>

                                        <div class="description">
                                            {{ $checkitem->detail }}
                                        </div>
                                    </div>
                                    <div class="extra content">
                                        <div class="right floated inline fields">
                                            @include('components.checkitem-radio-buttons', compact('checkitem'))
                                        </div>
                                        @if (!is_null($checkitem->faultImprovement))
                                            @if (is_null($checkitem->faultImprovement->passes))
                                                <a
                                                    href="{{ route('projects.fault-improvements.show', [$project->id, $checkitem->faultImprovement->id]) }}"
                                                    class="ui label"
                                                >
                                                    {{ trans_choice('all.fault_improvements', 1) }}
                                                </a>
                                            @elseif (!is_null($checkitem->faultImprovement->passes) && $checkitem->faultImprovement->passes)
                                                <a
                                                    href="{{ route('projects.fault-improvements.show', [$project->id, $checkitem->faultImprovement->id]) }}"
                                                    class="ui green label"
                                                >
                                                    {{ trans_choice('all.fault_improvements', 1) }}
                                                </a>
                                            @else
                                                <a
                                                    href="{{ route('projects.fault-improvements.show', [$project->id, $checkitem->faultImprovement->id]) }}"
                                                    class="ui red label"
                                                >
                                                    {{ trans_choice('all.fault_improvements', 1) }}
                                                </a>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <h4 class="ui dividing header">完成數量</h4>
                        <div class="field">
                            <input type="text" name="passes_amount" value="{{ $checklist->passes_amount }}"></input>
                        </div>
                        <button class="ui primary button" type="submit">{{ trans('all.save') }}</button>
                    </form>
                </div>
            </div>
        </div>

    @endif
@stop
