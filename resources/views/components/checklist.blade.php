{{-- $checklist --}}

<div class="ui fluid card">

    <div class="content">

        <div class="header">
            <a href="{{ route('checklists.show', $checklist->id) }}">{{ $checklist->name }}</a>
        </div>

    </div>

    <div class="extra content">

        <form class="ui form right floated" action="{{ route('checklists.destroy', $checklist->id) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE')}}

            <div class="ui labels">
                <button type="submit" class="ui right floated red label" href="{{ route('checklists.index', $checklist->id) }}">刪除</button>
            </div>
        </form>
        <div class="ui labels">
            @if (!is_null($checklist->workflow))
                <a href="{{ route('checklists.workflow', $checklist->id) }}" class="ui label">
                    {{ $checklist->workflow->name }}
                </a>

                <a href="{{ route('checklists.works', $checklist->id) }}" class="ui label">
                    {{ $checklist->workflow->works->count() }} {{ trans_choice('all.work', $checklist->workflow->works->count()) }}
                </a>
            @endif

            <a href="{{ route('checklists.show', $checklist->id) }}" class="ui label">
                {{ $checklist->checkitems->count() }} {{ trans_choice('all.checkitems', $checklist->checkitems->count()) }}
            </a>
        </div>
    </div>

</div>
