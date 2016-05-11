{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    trans('all.internal') => route('projects.internal.index', $project->id),
    trans('all.p_bid') => route('projects.bid.works', $project->id),
    trans('all.create_work') => null,
] /* --}}

@extends('layouts.project')

@section('content')

    @if (count($errors))
        @include('messages.errors', [
            'header' => trans('all.please_fill_the_form'),
            'message' => trans('all.required_fields', ['fields' => implode(['Referenced Work', 'Name', 'Amount'])])
        ])
    @endif

    <div class="ui raised segment">
        <form method="POST" action="{{ route('projects.works.store', $project->id) }}" class="ui form">
            {{ csrf_field() }}

            <flowtype-work-select
                select-type-order-label="{{ trans('all.select_type_order') }}"
                select-work-label="{{ trans('all.select_workflow') }}"
            ></flowtype-work-select>

            <div class="field {{ $errors->has('name') ? 'error' : '' }}">
                <label>{{ trans('all.create_work') }}</label>
                <input type="text" name="name">
            </div>

            <button class="ui primary button" type="submit">{{ trans('all.create') }}</button>
            <a href="{{ route('projects.bid.works', $project->id) }}" class="ui primary button">{{ trans('all.back') }}</a>
            <a href="{{ route('works.create') }}" class="ui primary button">{{ trans('all.create_standard_work') }}</a>
        </form>
    </div>

@stop
