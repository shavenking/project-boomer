{{-- */ $breadcrumbs = [
    trans('all.settings') => route('settings.index'),
    trans('all.works') => route('works.index'),
    "{$work->name}" => null
] /* --}}

@extends('layouts.settings')

@section('content')



    @include('works._card', $work)

    <a href="{{ route('works.work-items.index', $work->id) }}" class="ui primary button"><i class="plus icon"></i>{{ trans('all.unit_price_analysis') }}</a>
    <a href="{{ route('works.index', $work->id) }}" class="ui primary button">{{ trans('all.back_works') }}</a>
@stop

