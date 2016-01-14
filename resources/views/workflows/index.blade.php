{{-- */ $breadcrumbs = [
    trans('all.settings') => route('settings.index'),
    trans_choice('all.workflows', 2) => null
] /* --}}

@extends('layouts.settings')

@section('content')
    <div class="ui grid">

        <div class="sixteen wide column">
            <a href="{{ route('workflows.create') }}" class="ui primary button"><i class="plus icon"></i>{{ trans('all.create_workflow') }}</a>
        </div>

        @if (count($workflows))
            @foreach ($workflows as $workflow)
                <div class="eight wide column">
                    @include ('components.workflow')
                </div>
            @endforeach
        @else
            <div class="sixteen wide column">
                @include('messages.empty')
            </div>
        @endif

    </div>
@stop
