{{-- */ $breadcrumbs = [
    trans('all.settings') => route('settings.index'),
    trans_choice('all.checklists', 2) => null
] /* --}}

@extends('layouts.settings')

@section('content')
    <a href="{{ route('checklists.create') }}" class="ui primary button">
        <i class="plus icon"></i>{{ trans('all.create_checklist') }}
    </a>

    @if ($checklists->isEmpty())
        @include('messages.empty')
    @else
        <div class="ui raised segment">
            <ol class="ui relaxed list">
                @foreach ($checklists as $checklist)
                    <li><a href="{{ route('checklists.show', $checklist->id) }}" class="header">{{ $checklist->name }}</a></li>
                @endforeach
            </ol>
        </div>
    @endif
@stop
