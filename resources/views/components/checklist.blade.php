{{-- $checklist --}}

<div class="ui fluid card">

    <div class="content">

        <div class="header">
            <a href="{{ route('checklists.show', $checklist->id) }}">{{ $checklist->name }}</a>
        </div>

    </div>

    <div class="extra content">
        <div class="ui labels">
            @if (!is_null($checklist->workflow))
                <a href="{{ route('checklists.workflow', $checklist->id) }}" class="ui label">
                    {{ $checklist->workflow->name }}
                </a>

                <a href="{{ route('checklists.works', $checklist->id) }}" class="ui label">
                    {{ $checklist->workflow->works->count() }} {{ trans_choice('all.works', $checklist->workflow->works->count()) }}
                </a>
            @endif

            <a href="{{ route('checklists.show', $checklist->id) }}" class="ui label">
                {{ $checklist->checkitems->count() }} {{ trans_choice('all.checkitems', $checklist->checkitems->count()) }}
            </a>
        </div>
    </div>

</div>
