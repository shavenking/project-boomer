<a href="{{ route('projects.bid.index', $project->id) }}" class="@if (preg_match('/projects\.(bid|works).*/', request()->route()->getName())) active @endif item">
    標單管理
</a>
