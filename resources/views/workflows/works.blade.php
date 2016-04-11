{{-- */ $breadcrumbs = [
    trans('all.settings') => route('settings.index'),
    trans_choice('all.workflows', 2) => route('workflows.index'),
    "{$workflow->name}" => route('workflows.show', $workflow->id),
    trans('all.set_works') => null
] /* --}}

@extends('layouts.settings')

@section('content')

    <div class="ui secondary pointing menu">
        <a href="{{ route('workflows.show', $workflow->id) }}" class="item">{{ trans('all.workflow') }}</a>
        <a href="{{ route('workflows.works', $workflow->id) }}" class="active item">{{ trans('all.set_works') }}</a>
    </div>

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
                        <a href="{{ route('works.show', $work->id) }}">{{ $work->name }}</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="center aligned">{{ trans('all.empty_works') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('works.create') }}" class="ui primary button"><i class="plus icon"></i>{{ trans('all.create_work') }}</a>
    <a href="{{ route('workflows.show', $workflow->id) }}" class="ui primary button"><i class="plus icon"></i>{{ trans('all.back_workflows') }}</a>

@stop
