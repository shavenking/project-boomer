@extends('layouts.general')

@section('title')
    Settings | Check Lists
@stop

@section('sidebar')
    @include('partials.settings-sidebar')
@stop

@section('breadcrumbs')
    <a href="{{ route('settings.index') }}" class="section">Settings</a>

    <i class="right chevron icon divider"></i>

    <a href="{{ route('checklists.index') }}" class="section">Check Lists</a>

    <i class="right chevron icon divider"></i>

    <div class="active section">Create</div>
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
