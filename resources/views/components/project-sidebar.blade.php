<div class="item">
    <div class="header">Internal</div>
    <div class="menu">
        <a
            href="{{ route('projects.bid.index', $project->id) }}"
            class="@if (preg_match('/projects\.(bid|works).*/', request()->route()->getName())) active @endif item">
            Bid
        </a>
    </div>
</div>

<div class="item">
    <div class="header">External</div>
    <div class="menu">
        <a
            href="{{ route('projects.checklists.index', $project->id) }}"
            class="@if (str_is('projects.checklists*', request()->route()->getName())) active @endif item"
        >
            Check Lists
        </a>
    </div>
</div>
