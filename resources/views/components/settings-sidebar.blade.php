<div class="ui fluid vertical pointing menu">
    <a
        href="{{ route('workflows.index') }}"
        class="@if (str_is('workflows*', request()->route()->getName())) active @endif item"
    >
        {{ trans_choice('all.workflows', 2) }}
    </a>

    <a
        href="{{ route('works.index') }}"
        class="@if (str_is('works*', request()->route()->getName())) active @endif item"
    >
        {{ trans_choice('all.works', 2) }}
    </a>

    <a
        href="{{ route('checklists.index') }}"
        class="@if (str_is('checklists*', request()->route()->getName())) active @endif item"
    >
        {{ trans_choice('all.checklists', 2) }}
    </a>
    <a
        href="#"
        class="item">
        {{ trans('all.subcontractor') }}
    </a>
    <a
        href="#"
        class="item">
        {{ trans('all.personal') }}
    </a>
</div>
