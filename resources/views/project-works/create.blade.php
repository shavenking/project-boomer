{{-- */ $breadcrumbs = [
    'Projects' => route('projects.index'),
    "{$project->name}" => route('projects.show', $project->id),
    'Internal' => route('projects.internal', $project->id),
    'Bid' => route('projects.bid.index', $project->id),
    'Works' => route('projects.bid.works', $project->id),
    'Create' => null
] /* --}}

@extends('layouts.project')

@section('sidebar')
    @include('partials.internal-sidebar')
@stop

@section('content')

    @if (count($errors))
        @include('messages.errors', [
            'header' => '請填寫欄位',
            'message' => '必填項目：參考工項、名稱、數量'
        ])
    @endif

    <div class="ui raised segment">
        @include('components.form-create-project-work', [
            'project' => $project,
            'csrfToken' => csrf_token()
        ])
    </div>

@stop
