<div class="ui vertical pointing menu">
    <a
        href="{{ route('projects.bid.index', $project->id) }}"
        class="@if (preg_match('/projects\.(bid|works).*/', request()->route()->getName())) active @endif item">
        {{ trans('all.p_bid') }}
    </a>
    <a
        href="#"
        class="item">
        {{ trans('all.p_schedule') }}
    </a>
    <a
        href="#"
        class="item">
        {{ trans('all.p_preparation') }}
    </a>
</div>
