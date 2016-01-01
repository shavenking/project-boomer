{{-- */ $breadcrumbs = [
    'Settings' => route('settings.index'),
    'Workflows' => null
] /* --}}

@extends('layouts.general')

@section('sidebar')
    @include('partials.settings-sidebar')
@stop

@section('content')
    <div id="workflow-list"><!-- React Component --></div>
@stop
