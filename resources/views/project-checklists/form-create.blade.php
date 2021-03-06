{{-- $project, $checklists --}}
<form action="{{ route('projects.checklists.store', $project->id) }}" method="POST" class="ui form">
    <h4 class="ui dividing header">工作項目</h4>
    <project-flowtype-work-select project-id="{{ $project->id }}"></project-flowtype-work-select>

    <h4 class="ui dividing header">施工部位</h4>
    <div class="field">
        <input type="text" name="seat">
    </div>

    <h4 class="ui dividing header">選擇協力廠商</h4>
    <div class="field">
        <subcontractor-select></subcontractor-select>
    </div>

    {{ csrf_field() }}
    <button class="ui primary button" type="submit">{{ trans('all.create') }}</button>
    <a href="{{ route('projects.checklists.index', $project->id) }}" class="ui primary button">
         返回
    </a>
</form>
