@extends('layouts.general-nosidebar')

@section('title')
    專案首頁
@stop

@section('navbar')
    @include('partials.navbar')
@stop

@section('breadcrumbs')
    <div class="active section">專案</div>
@stop

@section('content')
    <table class="ui celled table">
        <thead>
            <tr>
                <th>專案名稱</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($projects as $project)
                <tr>
                    <td class="selectable">
                        <a href="{{ route('projects.show', $project->id) }}">{{ $project->name }}</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="center aligned">目前沒有專案</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th class="right aligned">
                    <a href="{{ route('projects.create') }}" class="ui primary labeled icon button">
                        <i class="plus icon"></i> 新增專案
                    </a>
                </th>
            </tr>
        </tfoot>
    </table>
@stop
