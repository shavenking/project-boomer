{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => null
] /* --}}

@extends('layouts.general-nosidebar')

@section('content')
    <table class="ui celled table">
        <thead>
            <tr>
                <th>{{ trans('all.name') }}</th>
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
                    <td class="center aligned">{{ trans('all.empty_projects') }}</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th class="right aligned">
                    <a href="{{ route('projects.create') }}" class="ui primary labeled icon button">
                        <i class="plus icon"></i>{{ trans('all.create_project') }}
                    </a>
                </th>
            </tr>
        </tfoot>
    </table>
@stop
