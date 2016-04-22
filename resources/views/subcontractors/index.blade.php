{{-- */ $breadcrumbs = [
    trans('all.settings') => route('settings.index'),
    trans('all.subcontractors') => null
] /* --}}

@extends('layouts.settings')

@section('content')
    <div class="sixteen wide column">
            <a href="#" class="ui primary button">
                <i class="plus icon"></i>{{ trans('all.create_subcontractor') }}
            </a>
    </div>
@stop
