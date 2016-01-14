{{-- */ $breadcrumbs = [
    trans('all.settings') => route('settings.index'),
    trans_choice('all.workflows', 2) => route('workflows.index'),
    "{$workflow->name}" => route('workflows.show', $workflow->id),
    trans_choice('all.works', 2) => null
] /* --}}

@extends('layouts.settings')

@section('content')

    <div class="ui secondary pointing menu">
        <a href="{{ route('workflows.show', $workflow->id) }}" class="item">{{ trans_choice('all.workflows', 2) }}</a>
        <a href="{{ route('workflows.works', $workflow->id) }}" class="active item">{{ trans_choice('all.works', 2) }}</a>
        <a href="{{ route('workflows.checklist', $workflow->id) }}" class="item">{{ trans_choice('all.checklists', 1) }}</a>
    </div>

    <table class="ui celled table">
        <thead>
            <tr>
                <th>{{ trans('all.name') }}</th>
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

@stop
