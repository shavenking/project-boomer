{{-- $workflows --}}

<select name="workflow_id" class="ui dropdown">
    @foreach ($workflows as $workflow)
        <option value="{{ $workflow->id }}" @if (request()->query('workflow_id') == $workflow->id) selected @endif>{{ $workflow->name }}</option>
    @endforeach
</select>
