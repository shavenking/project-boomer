<a href="{{ route('workflows.index') }}" class="@if (str_is('workflows*', request()->route()->getName())) active @endif item">
    施工流程管理
</a>

<a href="{{ route('works.index') }}" class="@if (str_is('works*', request()->route()->getName())) active @endif item">
    工作項目管理
</a>

<a href="{{ route('check-lists.index') }}" class="@if (str_is('check-lists*', request()->route()->getName())) active @endif item">
    自主檢查表管理
</a>
