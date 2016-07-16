{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    '人員管理' => route('projects.members.index', $project->id),
    '快速新增成員' => null
] /* --}}

@extends('layouts.project')

@section('content')
    <h3>快速新增成員</h3>

        <table class="ui table">
            <thead>
                <tr>
                    <th>名稱</th>
                    <th>信箱</th>
                    <th>權限</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="collapsing">
                            <form action="{{ route('projects.members.fast-store', $project->id) }}" method="POST" class="ui form">
                                {{ csrf_field() }}

                                <input type="hidden" name="email" value="{{ $user->email }}">

                                <div class="inline field">
                                    <select class="ui dropdown" name="role_name">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}">{{ $role->display_name }}</option>
                                        @endforeach
                                    </select>

                                    <button class="ui primary button" type="submit">{{ trans('all.create') }}</button>
                                </div>

                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
@stop
