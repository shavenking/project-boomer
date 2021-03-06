{{-- */ $breadcrumbs = [
    trans_choice('all.projects', 2) => route('projects.index'),
    trans('all.create') => null
] /* --}}

@extends('layouts.general-nosidebar')

@section('content')

    <form class="ui form {{ count($errors) ? 'error' : '' }}" action="{{ route('projects.store') }}" method="POST">
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

    </form>

@stop
