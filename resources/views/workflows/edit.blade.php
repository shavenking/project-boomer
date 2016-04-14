{{-- */ $breadcrumbs = [
    trans('all.settings') => route('settings.index'),
    trans_choice('all.workflows', 2) => route('workflows.index'),
    trans('all.create_workflow') => null
] /* --}}

@extends('layouts.settings')

@section('content')

    <div class="ui raised segment">
        <form class="ui form {{ count($errors) ? 'error' : '' }}" action="{{ route('workflows.update', $workflow->id) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="field {{ $errors->has('name') ? 'error' : '' }}">
                <label>{{ trans('all.name') }}</label>
                <input type="text" name="name" value="{{ $workflow->name }}">
            </div>



            @if ($errors->has('name'))
                <div class="ui error message">
                    <div class="header">{{ trans('all.please_fill_the_form') }}</div>
                    <p>{{ trans('all.please_fill_the_form') }}</p>
                </div>
            @endif

            <button class="ui primary button" type="submit">{{ trans('all.save') }}</button>
        </form>
    </div>

@stop
