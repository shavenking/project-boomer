{{-- */ $breadcrumbs = [
    trans('all.settings') => route('settings.index'),
    trans_choice('all.workflows', 2) => null
] /* --}}

@extends('layouts.settings')

@section('content')
    <div id="workflow-list"><!-- React Component --></div>
@stop
