<h3 class="header">{{ trans('all.external') }}</h3>
<div class="ui fluid vertical buttons">
    <a
        href="{{ route('projects.construction-dailies.index', $project->id) }}"
        class="ui @if (preg_match('/projects\.(construction-dailies).*/', request()->route()->getName())) active @endif button"
    >
        {{ trans('all.p_construction_daily') }}
    </a>
    <a
        href="{{ route('projects.checklists.index', $project->id) }}"
        class="ui @if (preg_match('/projects\.(checklists).*/', request()->route()->getName())) active @endif button"
    >
        {{ trans('all.p_checklist') }}
    </a>
    <a
        href="{{ route('projects.fault-improvements.index', $project->id) }}"
        class="ui @if (preg_match('/projects\.(fault-improvements).*/', request()->route()->getName())) active @endif button"
    >
        {{ trans('all.p_fault_improvement') }}
    </a>
</div>

