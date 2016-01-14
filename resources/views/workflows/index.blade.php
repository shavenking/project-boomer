{{-- */ $breadcrumbs = [
    trans('all.settings') => route('settings.index'),
    trans_choice('all.workflows', 2) => null
] /* --}}

@extends('layouts.settings')

@section('content')
    <div class="ui grid">
        <div class="column">
            <a href="{{ route('workflows.create') }}" class="ui primary button"><i class="plus icon"></i>{{ trans('all.create_workflow') }}</a>
        </div>
    </div>

    <div class="ui two column grid">
        @foreach ($workflows as $workflow)
            <div class="column">
                @include ('components.workflow')
            </div>
        @endforeach
    </div>
@stop
