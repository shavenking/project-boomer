<a class="ui fluid card" href="{{ route('works.work-items.index', $work->id) }}">

    <div class="content">

        <div class="header">
            <div class="ui right floated">$ {{ $work->total_price }}</div>
            {{ $work->name }}
        </div>

        <div class="meta">
            <span>{{ $work->detailingflowType->mainflowType->name }} - {{ $work->detailingflowType->name }}</span>
        </div>

        <div class="description">
        </div>

    </div>

    <div class="extra content">
        <div class="ui labels">
            <div class="ui label">數量 {{ $work->amount }}</div>
            <div class="ui label">單價 {{ $work->unit_price }}</div>
            <div class="ui label">{{ $work->unit->name }}</div>
        </div>
    </div>

</a>
