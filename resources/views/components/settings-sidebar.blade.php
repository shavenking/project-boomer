<div class="ui vertical menu">
    <div class="item">
        <div class="header">{{ trans('all.settings') }}</div>

        <div class="menu">

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

        </div>
    </div>
</div>
