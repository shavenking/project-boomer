<div class="ui vertical pointing menu">
    <a
        href="{{ route('projects.bid.index', $project->id) }}"
        class="@if (preg_match('/projects\.(bid|works).*/', request()->route()->getName())) active @endif item">
        {{ trans('all.bid') }}
    </a>
</div>
