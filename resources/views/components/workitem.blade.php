{{-- $proejct?, $workitem --}}

{{-- */
    $editRoute = isset($project) ?
        route('projects.works.workitems.edit', [$project->id, $workitem->work->id, $workitem->id]) :
        ''
/* --}}

{{-- */
    $deleteRoute = isset($project) ?
        route('projects.works.workitems.destroy', [$project->id, $workitem->work->id, $workitem->id]) :
        ''
/* --}}

<div class="ui fluid card">

    <div class="content">

        <div class="header">
            <div class="ui right floated">$ {{ $workitem->total_price }}</div>
            {{ $workitem->name }}
        </div>

        <div class="meta">
            <span>{{ $workitem->costType->name }}</span>
        </div>

    </div>

    <div class="extra content">
        <form class="ui form right floated" action="{{ $deleteRoute }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE')}}

            <div class="ui labels">
                <a href="{{ $editRoute }}" class="ui green label">{{ trans('all.edit') }}</a>
                <button type="submit" class="ui right floated red label">{{ trans('all.delete') }}</button>
            </div>
        </form>

        <div class="ui labels">
            <div class="ui label">{{ trans('all.amount') }} {{ $workitem->amount }}</div>
            <div class="ui label">{{ trans('all.unit_price') }} {{ $workitem->unit_price }}</div>
            <div class="ui label">{{ $workitem->unit->name }}</div>
        </div>
    </div>

</div>
