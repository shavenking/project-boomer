{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    '人員管理' => route('projects.members.index', $project->id),
    '新增成員' => null
] /* --}}

@extends('layouts.project')

@section('content')
    <h3>新增成員</h3>

    <form class="ui form" action="{{ route('projects.members.store', $project->id) }}" method="POST">
        {{ csrf_field() }}

        <div class="field">
            <label>信箱</label>
            <input type="text" name="email">
        </div>

        <div class="field">
            <label>權限</label>
            <select class="ui dropdown" name="role_name">
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}">{{ $role->display_name }}</option>
                @endforeach
            </select>
        </div>


        <button class="ui primary button" type="submit">{{ trans('all.create') }}</button>
    </form>
@stop
