{{-- $project, $works --}}
<table class="ui celled padded table">
    <thead>
        <tr>
            <th>工項名稱</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($works as $work)
            <tr>
                <td class="selectable">
                    <a href="{{ route('projects.works.show', [$project->id, $work->id]) }}">{{ $work->name }}</a>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot class="full width">
        <tr>
            <th>
                <a href="{{ route('projects.works.create', [$project->id]) }}" class="ui primary labeled icon button">
                    <i class="plus icon"></i>新增專案工項
                </a>
            </th>
        </tr>
    </tfoot>
</table>
