<div class="item">
    <div class="header">{{ trans('all.internal') }}</div>
    <div class="menu">
        <a
            href="{{ route('projects.bid.index', $project->id) }}"
            class="@if (preg_match('/projects\.(bid|works).*/', request()->route()->getName())) active @endif item">
            {{ trans('all.bid') }}
        </a>
    </div>
</div>

<div class="item">
    <div class="header">{{ trans('all.external') }}</div>
    <div class="menu">
        <a
            href="{{ route('projects.checklists.index', $project->id) }}"
            class="@if (str_is('projects.checklists*', request()->route()->getName())) active @endif item"
        >
            {{ trans_choice('all.checklists', 2) }}
        </a>
    </div>
</div>
