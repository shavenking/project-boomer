{{-- */ $breadcrumbs = [
    trans('all.settings') => route('settings.index'),
    trans_choice('all.checklists', 2) => route('checklists.index'),
    "{$checklist->name}" => null
] /* --}}

@extends('layouts.settings')

@section('content')

    <div class="ui secondary pointing menu">
        <a href="{{ route('checklists.show', $checklist->id) }}" class="active item">{{ $checklist->name }}</a>
        <a href="{{ route('checklists.workflow', $checklist->id) }}" class="item">{{ trans_choice('all.workflows', 1) }}</a>
        <a href="{{ route('checklists.works', $checklist->id) }}" class="item">{{ trans_choice('all.works', 1) }}</a>
    </div>

    <div class="ui raised segment">
        <h4 class="ui header">
            {{ trans_choice('all.checkitems', 2) }}
            @if ($checklist->checkitems->isEmpty())
                <div class="sub header">{{ trans('all.empty_checkitems') }}</div>
            @endif
        </h4>
        @if (!$checklist->checkitems->isEmpty())
            <div class="ui ordered list">
                @foreach ($checklist->checkitems as $checkitem)
                    <div class="item">
                        <div class="content">
                            <div class="header">{{ $checkitem->name }}</div>
                            <div class="description">{{ $checkitem->detail }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <div class="ui segment">
        <h4 class="ui dividing header">{{ trans('all.create_checkitem') }}</h4>

        <form action="{{ route('checklists.checkitems.store', $checklist->id) }}" method="POST" class="ui form">
            {{ csrf_field() }}

            <div class="field">
                <label>{{ trans('all.name') }}</label>
                <input type="text" name="name">
            </div>

            <div class="field">
                <label>{{ trans('all.detail') }}</label>
                <input type="text" name="detail">
            </div>

            <button class="ui primary button" type="submit">{{ trans('all.create') }}</button>
        </form>

    </div>
@stop
