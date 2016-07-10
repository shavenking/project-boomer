{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    '人員管理' => null
] /* --}}

@extends('layouts.project')

@section('content')

    <a href="{{ route('projects.members.create', $project->id) }}" class="ui primary labeled icon button">
        <i class="plus icon"></i>新增專案成員
    </a>

    <table class="ui table">
        <thead>
            <tr>
                <th>成員名稱</th>
                <th>成員角色</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($members as $member)
                <tr>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->role->display_name }}</td>
                    <td class="collapsing">
                        <form action="{{ route('projects.members.destroy', [$project->id, $member->id]) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button type="submit" class="ui red button">{{ trans('all.delete') }}</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@stop
