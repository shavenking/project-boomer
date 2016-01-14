{{-- */ $breadcrumbs = [
    trans('all.settings') => route('settings.index'),
    trans_choice('all.checklists', 2) => null
] /* --}}

@extends('layouts.settings')

@section('content')
    <div class="ui grid">
        <div class="column">
            <a href="{{ route('checklists.create') }}" class="ui primary button">
                <i class="plus icon"></i>{{ trans('all.create_checklist') }}
            </a>
        </div>
    </div>

    @if ($checklists->isEmpty())
        @include('messages.empty')
    @else
        <div class="ui two column grid">
            @foreach ($checklists as $checklist)
                <div class="column">
                    @include('components.checklist')
                </div>
            @endforeach
        </div>
    @endif
@stop
