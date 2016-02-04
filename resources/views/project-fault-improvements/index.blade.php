{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    trans_choice('all.fault_improvements', 2) => null
] /* --}}

@extends('layouts.project')

@section('content')

    <div class="ui raised segment">
        <ul class="ui relaxed list">
            @foreach ($checklists as $checklist)
                <li>
                    <a href="{{ route('projects.checklists.show', [$project->id, $checklist->id]) }}" class="header">
                        {{ $checklist->name }}    
                    </a>
                    
                    <ul>
                        @foreach ($checklist->checkitems as $checkitem)
                            @if ($checkitem->faultImprovement)
                                <li>
                                    <a 
                                        href="{{ route('projects.fault-improvements.show', [$project->id, $checkitem->faultImprovement->id]) }}" 
                                        class="header"
                                    >
                                        {{ $checkitem->name }} - {{ $checkitem->detail }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>

@stop
