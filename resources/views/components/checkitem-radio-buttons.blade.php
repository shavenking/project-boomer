{{-- $checkitem --}}
<div class="field">
    <div class="ui radio checkbox">
        <input
            type="radio"
            name="passes[{{ $checkitem->id }}]"
            value="null"
            tabindex="0"
            @if (is_null($checkitem->passes)) checked @endif
        >
        <label>unchecked</label>
    </div>
</div>
<div class="field">
    <div class="ui radio checkbox">
        <input
            type="radio"
            name="passes[{{ $checkitem->id }}]"
            value="1"
            tabindex="0"
            @if (!is_null($checkitem->passes) && $checkitem->passes) checked @endif
        >
        <label>passes</label>
    </div>
</div>
<div class="field">
    <div class="ui radio checkbox">
        <input
            type="radio"
            name="passes[{{ $checkitem->id }}]"
            value="0"
            tabindex="0"
            @if (!is_null($checkitem->passes) && !$checkitem->passes) checked @endif
        >
        <label>failed</label>
    </div>
</div>
