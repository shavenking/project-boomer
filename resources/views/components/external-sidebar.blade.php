<div class="ui vertical pointing menu">
    <a
        href="{{ route('projects.checklists.index', $project->id) }}"
        class="@if (preg_match('/projects\.(checklists).*/', request()->route()->getName())) active @endif item"
    >
        {{ trans_choice('all.checklists', 2) }}
    </a>
</div>
