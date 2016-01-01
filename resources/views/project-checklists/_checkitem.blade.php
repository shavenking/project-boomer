{{-- $checkitem --}}
<div class="item">
    <div class="middle aligned content">
        <div class="header">
            @if (!is_null($checkitem->passes) && $checkitem->passes)
                <i class="green check icon"></i>
            @endif
            @if (!is_null($checkitem->passes) && !$checkitem->passes)
                <i class="red remove icon"></i>
            @endif
            {{ $checkitem->name }}
        </div>
        <div class="description">{{ $checkitem->detail }}</div>
        <div class="extra">
            <div class="inline right floated fields">
                @include('components.checkitem-radio-buttons', compact('checkitem'))
            </div>
        </div>
    </div>
</div>
