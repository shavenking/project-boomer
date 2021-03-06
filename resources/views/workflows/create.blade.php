{{-- */ $breadcrumbs = [
    trans('all.settings') => route('settings.index'),
    trans_choice('all.workflows', 2) => route('workflows.index'),
    trans('all.create_workflow') => null
] /* --}}

@extends('layouts.settings')

@section('content')

    <div class="ui raised segment">
        <form class="ui form {{ count($errors) ? 'error' : '' }}" action="{{ route('workflows.store') }}" method="POST">
            {{ csrf_field() }}

            <div class="field {{ $errors->has('name') ? 'error' : '' }}">
                <label>{{ trans('all.name') }}</label>
                <input type="text" name="name">
            </div>



            @if ($errors->has('name'))
                <div class="ui error message">
                    <div class="header">{{ trans('all.please_fill_the_form') }}</div>
                    <p>{{ trans('all.please_fill_the_form') }}</p>
                </div>
            @endif

            <button class="ui primary button" type="submit">{{ trans('all.create') }}</button>
            <a href="{{ route('workflows.index') }}" class="ui primary button">{{ trans('all.back') }}</a>
        </form>
    </div>

@stop
