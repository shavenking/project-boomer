{{-- */ $breadcrumbs = [
    'Settings' => route('settings.index'),
    'Checklists' => route('checklists.index'),
    'Create' => null
] /* --}}

@extends('layouts.general')

@section('sidebar')
    @include('partials.settings-sidebar')
@stop

@section('content')
    <div class="ui raised segment">
        <form action="{{ route('checklists.store') }}" method="POST" class="ui form">
            {{ csrf_field() }}

            <div class="field">
                <label>Select Workflow&nbsp;or&nbsp;<a href="{{ route('workflows.create') }}">Create New Workflow</a></label>
                @include('components.dropdown-workflow-select')
            </div>


            <div class="field">
                <label>Name</label>
                <input type="text" name="name">
            </div>

            <button class="ui primary button" type="submit">Create</button>
        </form>
    </div>
@stop
