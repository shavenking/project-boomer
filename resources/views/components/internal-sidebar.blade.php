<h3 class="header">{{ trans('all.internal') }}</h3>
<div class="ui fluid vertical buttons">
    <a
        href="{{ route('projects.bid.works', $project->id) }}"
        class="ui @if (preg_match('/projects\.(bid|works).*/', request()->route()->getName())) active @endif button"
    >
        {{ trans('all.p_bid') }}
    </a>
    <a
        href="#"
        class="ui disabled button"
    >
        {{ trans('all.p_cost') }}
    </a>
    <a
        href="#"
        class="ui disabled button"
    >
        {{ trans('all.p_schedule') }}
    </a>
    <a
        href="#"
        class="ui disabled button"
    >
        {{ trans('all.p_preparation') }}
    </a>
</div>
