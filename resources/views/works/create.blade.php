{{-- */ $breadcrumbs = [
    trans('all.settings') => route('settings.index'),
    trans_choice('all.works', 2) => route('works.index'),
    trans('all.create') => null
] /* --}}

@extends('layouts.settings')

@section('content')
    <form class="ui form {{ count($errors) ? 'error' : '' }}" method="POST" action="{{ route('works.store') }}">
        {{ csrf_field() }}

        <div class="equal width fields">
            <div class="field {{ $errors->has('name') ? 'error' : '' }}">
                <label>{{ trans('all.name') }}</label>
                <input type="text" name="name" placeholder="名稱">
            </div>
        </div>

        <div class="field">
            <label>{{ trans('all.select_unit') }}</label>
            <unit-select></unit-select>
        </div>

        <div class="field">
            <label>{{ trans('all.select_type_order') }}</label>
            <flowtype-select></flowtype-select>
        </div>


        <div class="field">
            <label>{{ trans('all.set_workflows') }}&nbsp;{{ trans('all.or') }}&nbsp;<a href="{{ route('workflows.create') }}">{{ trans('all.create_workflow') }}</a></label>
            <workflow-select default-value="{{ request()->query('workflow_id') }}"></workflow-select>
        </div>


        <input type="hidden" name="amount"  value="1" >


        @if (count($errors))
            <div class="ui error message">
                <div class="header">{{ trans('all.please_fill_the_form') }}</div>
                <p>{{ trans('all.please_fill_the_form') }}</p>
            </div>
        @endif

        <button class="ui primary button" type="submit">{{ trans('all.create') }}</button>
    </div>
@stop
