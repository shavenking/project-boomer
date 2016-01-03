{{-- $faultImprovement --}}
<div class="field">
    <div class="ui radio checkbox">
        <input
            type="radio"
            name="passes"
            value="null"
            tabindex="0"
            @if (is_null($faultImprovement->passes)) checked @endif
        >
        <label>unchecked</label>
    </div>
</div>
<div class="field">
    <div class="ui radio checkbox">
        <input
            type="radio"
            name="passes"
            value="1"
            tabindex="0"
            @if (!is_null($faultImprovement->passes) && $faultImprovement->passes) checked @endif
        >
        <label>passes</label>
    </div>
</div>
<div class="field">
    <div class="ui radio checkbox">
        <input
            type="radio"
            name="passes"
            value="0"
            tabindex="0"
            @if (!is_null($faultImprovement->passes) && !$faultImprovement->passes) checked @endif
        >
        <label>failed</label>
    </div>
</div>
