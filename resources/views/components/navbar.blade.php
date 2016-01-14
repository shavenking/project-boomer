<div class="ui borderless inverted menu">

    <a href="{{ route('index') }}" class="header item">
        公司名稱
    </a>

    <div class="right menu">
        <a href="{{ route('projects.index') }}" class="@if (request()->is('*projects*')) active @endif item">
            專案
        </a>
        <a href="{{ route('settings.index') }}" class="@if (request()->is('*settings*', '*workflows*', 'works*')) active @endif item">
            設定
        </a>
    </div>

</div>
