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

    <form action="{{ route('checklists.store') }}" method="POST" class="ui form">
        {{ csrf_field() }}

        <div class="grouped field">
            @include('components.workflow-select')
        </div>

        <div class="field">
            <label>Name</label>
            <input type="text" name="name">
        </div>

        <button class="ui primary button" type="submit">Create</button>
    </form>

@stop
