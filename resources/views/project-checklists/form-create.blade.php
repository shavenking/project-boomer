{{-- $project, $checklists --}}
<form action="{{ route('projects.checklists.store', $project->id) }}" method="POST" class="ui form">
    {{ csrf_field() }}

    <div class="field">
        <label>{{ trans('all.referenced_checklist') }}</label>
        <select name="checklist_id" class="ui selection dropdown">
            @foreach ($checklists as $checklist)
                <option value="{{ $checklist->id }}">{{ $checklist->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="field">
        <label>{{ trans('all.custom_name') }}</label>
        <input type="text" name="name">
    </div>

    <button class="ui primary button" type="submit">{{ trans('all.create') }}</button>
</form>
