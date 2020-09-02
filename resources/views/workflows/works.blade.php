{{-- */ $breadcrumbs = [
    trans('all.settings') => route('settings.index'),
    trans_choice('all.workflows', 2) => route('workflows.index'),
    "{$workflow->name}" => route('workflows.show', $workflow->id),
    trans('all.set_works') => null
] /* --}}

@extends('layouts.settings')

@section('content')


    <table class="ui celled table">
        <thead>
            <tr>
                <th>{{ trans('all.fs_works') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($works as $work)
                <tr>
                    <td class="selectable">
                        <a href="{{ route('workflows.showWorkItems', [$workflow->id, $work->id]) }}">{{ $work->name }}</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="center aligned">{{ trans('all.empty_works') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('workflows.createWork', $workflow->id) }}" class="ui primary button"><i class="plus icon"></i>{{ trans('all.create_work') }}</a>
    <a href="{{ route('workflows.show', $workflow->id) }}" class="ui primary button">{{ trans('all.back_workflows') }}</a>

@stop
