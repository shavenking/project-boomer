<div class="ui two item menu">
    <a
        href="{{ route('projects.internal.index', $project->id) }}"
        class="@if (preg_match('/projects\.(internal|bid|works).*/', request()->route()->getName())) active @endif item"
    >
        {{ trans('all.internal') }}
    </a>
    <a
        href="{{ route('projects.external.index', $project->id) }}"
        class="@if (preg_match('/projects\.(external|checklists).*/', request()->route()->getName())) active @endif item"
    >
        {{ trans('all.external') }}
    </a>
</div>
