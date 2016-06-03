<h3 class="header">{{ trans('all.settings') }}</h3>
<div class="ui fluid vertical buttons">
    <a
        href="{{ route('workflows.index') }}"
        class="ui @if (str_is('workflows*', request()->route()->getName())) active @endif button"
    >
        {{ trans_choice('all.workflows', 2) }}
    </a>

    <a
        href="{{ route('works.index') }}"
        class="ui @if (str_is('works*', request()->route()->getName())) active @endif button"
    >
        {{ trans_choice('all.works', 2) }}
    </a>

    <a
        href="{{ route('checklists.index') }}"
        class="ui @if (str_is('checklists*', request()->route()->getName())) active @endif button"
    >
        {{ trans('all.m_checklists') }}
    </a>
    <a
        href="{{ route('subcontractors.index') }}"
        class="ui button">
        {{ trans('all.subcontractors') }}
    </a>
    <a
        href="#"
        class="ui disabled button">
        {{ trans('all.schedules') }}
    </a>
    <a
        href="#"
        class="ui disabled button">
        {{ trans('all.personals') }}
    </a>
</div>
