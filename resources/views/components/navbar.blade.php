<div class="ui borderless inverted menu">

    <a href="{{ route('index') }}" class="header item">
        {{ trans('all.company_name') }}
    </a>

    <div class="right menu">
        <a href="{{ route('projects.index') }}" class="@if (request()->is('*projects*')) active @endif item">
            {{ trans_choice('all.projects', 2) }}
        </a>
        <a href="{{ route('settings.index') }}" class="@if (request()->is('*settings*', '*workflows*', 'works*')) active @endif item">
            {{ trans('all.settings') }}
        </a>
    </div>

</div>
