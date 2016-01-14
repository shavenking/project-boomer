{{-- */ $breadcrumbs = [
    trans('all.settings') => route('settings.index'),
    trans_choice('all.works', 2) => null
] /* --}}

@extends('layouts.settings')

@section('content')
    <div class="ui basic segment">
        <a href="{{ route('works.create') }}" class="ui primary button"><i class="plus icon"></i>{{ trans('all.create_work') }}</a>
    </div>
    @if (count($works))
        <div class="ui two column grid">
            @foreach ($works as $work)
                <div class="column">
                    @include('works._card', $work)
                </div>
            @endforeach
        </div>
    @else
        <p>{{ trans('all.empty_works') }} <a href="{{ route('works.create') }}">{{ trans('all.create') }}</a></p>
    @endif
@stop
