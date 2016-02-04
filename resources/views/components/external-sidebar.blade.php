<div class="ui vertical pointing menu">
    <a
        href="{{ route('projects.checklists.index', $project->id) }}"
        class="@if (preg_match('/projects\.(checklists).*/', request()->route()->getName())) active @endif item"
    >
        {{ trans('all.p_checklists') }}
    </a>
        <a
        href="{{ route('projects.fault-improvements.index', $project->id) }}"
        class="@if (preg_match('/projects\.(fault-improvements).*/', request()->route()->getName())) active @endif item"
    >
        {{ trans('all.p_fault_improvements') }}
    </a>
    <a
        href="#"
        class="item"
    >
        {{ trans('all.p_construction_dailys') }}
    </a>
</div>
