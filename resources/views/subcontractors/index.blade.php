{{-- */ $breadcrumbs = [
    trans('all.settings') => route('settings.index'),
    trans('all.subcontractors') => null
] /* --}}

@extends('layouts.settings')

@section('content')
    <a href="{{ route('subcontractors.create') }}" class="ui primary button">
        <i class="plus icon"></i>{{ trans('all.create_subcontractor') }}
    </a>

    <table class="ui table">
        <thead>
            <tr>
                <th>協力廠商名稱</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subcontractors as $subcontractor)
                <tr>
                    <td>
                        {{ $subcontractor->name }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
