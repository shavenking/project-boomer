<a href="{{ route('projects.bid.index', $project->id) }}" class="@if (str_is('projects.bid*', request()->route()->getName())) active @endif item">
    標單管理
</a>
