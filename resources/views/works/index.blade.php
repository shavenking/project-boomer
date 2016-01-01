{{-- */ $breadcrumbs = [
    'Settings' => route('settings.index'),
    'Works' => null
] /* --}}

@extends('layouts.general')

@section('sidebar')
    @include('partials.settings-sidebar')
@stop

@section('content')
    <div class="ui basic segment">
        <a href="{{ route('works.create') }}" class="ui primary button"><i class="plus icon"></i>新增工作項目</a>
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
        <p>目前沒有工項，請 <a href="{{ route('works.create') }}">點我</a> 新增</p>
    @endif
@stop
