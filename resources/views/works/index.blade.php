{{-- */ $breadcrumbs = [
    trans('all.settings') => route('settings.index'),
    trans_choice('all.works', 2) => null
] /* --}}

@extends('layouts.settings')

@section('content')
    <div class="ui grid">

        <div class="sixteen wide column">
            <a href="{{ route('works.create') }}" class="ui primary button">
                <i class="plus icon"></i>{{ trans('all.create_work') }}
            </a>
        </div>

        @if (count($works))
            @foreach ($works as $work)
                <div class="eight wide column">
                    @include('works._card', $work)
                </div>
            @endforeach
        @else
            <div class="sixteen wide column">
                @include('messages.empty')
            </div>
        @endif

    </div>
@stop
