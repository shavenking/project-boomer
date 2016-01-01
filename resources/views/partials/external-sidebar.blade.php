<a
    href="{{ route('projects.checklists.index', $project->id) }}"
    class="@if (str_is('projects.checklists*', request()->route()->getName())) active @endif item"
>
    Check Lists
</a>
