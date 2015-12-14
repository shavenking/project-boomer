<div class="ui fluid card">

    <div class="content">

        <div class="header">
            <div class="ui right floated">$ {{ $work->total_price }}</div>
            <a href="{{ route('works.work-items.index', $work->id) }}">{{ $work->name }}</a>
        </div>

        <div class="meta">
            <span>{{ $work->detailingflowType->mainflowType->name }} - {{ $work->detailingflowType->name }}</span>
        </div>

    </div>

    <div class="extra content">
        <form class="ui form right floated" action="{{ route('works.destroy', $work->id) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE')}}

            <div class="ui labels">
                <button type="submit" class="ui right floated red label" href="{{ route('works.work-items.index', $work->id) }}">刪除</button>
            </div>
        </form>

        <div class="ui labels">
            <div class="ui label">數量 {{ $work->amount }}</div>
            <div class="ui label">單價 {{ $work->unit_price }}</div>
            <div class="ui label">{{ $work->unit->name }}</div>
        </div>
    </div>

</div>
