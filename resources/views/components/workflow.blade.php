{{-- $workflow --}}

<div class="ui fluid card">

    <div class="content">

        <div class="header">
            <a href="{{ route('workflows.show', $workflow->id) }}">{{ $workflow->name }}</a>
        </div>

    </div>

    <div class="extra content">
        <form class="ui form right floated" action="{{ route('workflows.destroy', $workflow->id) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE')}}

            <div class="ui labels">
                <button type="submit" class="ui right floated red label">刪除</button>
            </div>
        </form>

        <div class="ui labels">
            <a href="{{ route('workflows.show', $workflow->id) }}" class="ui label">
                {{ $workflow->nodes->count() }} {{ trans_choice('all.workflow_nodes', $workflow->nodes->count()) }}
            </a>

            <a href="{{ route('workflows.works', $workflow->id) }}" class="ui label">
                {{ $workflow->works->count() }} {{ trans_choice('all.works', $workflow->works->count()) }}
            </a>

            @if (!is_null($workflow->checklist))
                <a href="{{ route('workflows.checklist', $workflow->id) }}" class="ui label">
                    {{ trans_choice('all.checklists', 1) }}
                </a>
            @endif
        </div>
    </div>

</div>
