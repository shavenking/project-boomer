{{-- */ $breadcrumbs = [
    'Settings' => route('settings.index'),
    'Workflows' => route('workflows.index'),
    "{$workflow->name}" => route('workflows.show', $workflow->id),
    'Works' => null
] /* --}}

@extends('layouts.general')

@section('sidebar')
    @include('partials.settings-sidebar')
@stop

@section('content')

    <div class="ui secondary pointing menu">
        <a href="{{ route('workflows.show', $workflow->id) }}" class="item">流程圖</a>
        <a href="{{ route('workflows.works', $workflow->id) }}" class="active item">工作項目列表</a>
        <a href="{{ route('workflows.checklist', $workflow->id) }}" class="item">Check List</a>
    </div>

    <table class="ui celled table">
        <thead>
            <tr>
                <th>工項名稱</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($works as $work)
                <tr>
                    <td class="selectable">
                        <a href="{{ route('works.show', $work->id) }}">{{ $work->name }}</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="center aligned">目前沒有工項</td>
                </tr>
            @endforelse
        </tbody>
        {{-- <tfoot>
            <tr>
                <th>
                    <a href="{{ route('works.create') }}" class="ui primary labeled icon button">
                        <i class="plus icon"></i> 新增工項
                    </a>
                </th>
            </tr>
        </tfoot> --}}
    </table>

@stop
