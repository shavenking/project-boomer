{{-- $project, $checklists --}}
<form action="{{ route('projects.checklists.store', $project->id) }}" method="POST" class="ui form">
    <h4 class="ui dividing header">施工工項</h4>
    <project-flowtype-work-select project-id="{{ $project->id }}"></project-flowtype-work-select>

    <h4 class="ui dividing header">自定檢查表名稱</h4>
    <div class="field">
        <input type="text" name="name">
    </div>

    <h4 class="ui dividing header">施工部位</h4>
    <div class="field">
        <input type="text" name="seat">
    </div>

    {{ csrf_field() }}
    <button class="ui primary button" type="submit">{{ trans('all.create') }}</button>
</form>
