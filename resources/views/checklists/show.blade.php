{{-- */ $breadcrumbs = [
    trans('all.settings') => route('settings.index'),
    trans('all.m_checklists') => route('checklists.index'),
    "{$checklist->name}" => null
] /* --}}

@extends('layouts.settings')

@section('content')

    <checklist checklist-id="{{ $checklist->id }}" title-label="{{ trans('all.title') }}" detail-label="{{ trans('all.detail') }}"></checklist>

    <a href="{{ route('checklists.index') }}" class="ui primary button"><i class="plus icon"></i>{{ trans('all.back_checklists') }}</a>
@stop
