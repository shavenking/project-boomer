{{-- */ $breadcrumbs = [
    trans('all.settings') => route('settings.index'),
    trans_choice('all.checklists', 2) => null
] /* --}}

@extends('layouts.settings')

@section('content')
    <div class="ui grid">

        <div class="sixteen wide column">
            <a href="{{ route('checklists.create') }}" class="ui primary button">
                <i class="plus icon"></i>{{ trans('all.create_checklist') }}
            </a>
        </div>

        @if (count($checklists))
            @foreach ($checklists as $checklist)
                <div class="eight wide column">
                    @include('components.checklist')
                </div>
            @endforeach
        @else
            <div class="sixteen wide column">
                @include('messages.empty')
            </div>
        @endif

    </div>
@stop
