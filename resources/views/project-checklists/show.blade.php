{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    trans_choice('all.checklists', 2) => route('projects.checklists.index', $project->id),
    "{$checklist->name}" => null
] /* --}}

@extends('layouts.project')

@section('content')

    @if ($checklist->checkitems->isEmpty())
        {{ trans('all.empty_checkitems') }}
    @else
        <form class="ui form" action="{{ route('projects.checklists.checkresults.update', [$project->id, $checklist->id])}}" method="POST">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <table class="ui celled table">
                <thead>
                    <tr>
                        <th>項目名稱</th>
                        <th>檢查標準</th>
                        <th class="collapsing">缺失改善表</th>
                        <th><!-- Buttons --></th>
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
                        <th colspan="4">
                            <button class="ui right floated primary button" type="submit">{{ trans('all.save') }}</button>
                        </th>
                    </tfoot>
                </tbody>
            </table>
        </form>
    @endif
@stop
