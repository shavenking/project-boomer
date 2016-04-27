<h3 class="header">{{ trans('all.finance') }}</h3>
<div class="ui fluid vertical buttons">
    <a
        href="{{ route('projects.cost-estimations.index', $project->id) }}"
        class="ui button"
    >
        {{ trans('all.p_estimation') }}
    </a>
</div>

