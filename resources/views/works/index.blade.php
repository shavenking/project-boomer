@extends('layouts.general')

@section('title')
    設定 ｜ 工項管理
@stop

@section('sidebar')
    <a href="{{ route('workflows.index') }}" class="item">
        流程管理
    </a>

    <a href="{{ route('works.index') }}" class="active item">
        工項管理
    </a>
@stop

@section('breadcrumbs')
    <a href="{{ route('settings.index') }}" class="section">設定</a>

    <i class="right chevron icon divider"></i>

    <div class="active section">工項管理</div>
@stop

@section('content')
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
        <tfoot>
            <tr>
                <th>
                    <a href="{{ route('works.create') }}" class="ui primary labeled icon button">
                        <i class="plus icon"></i> 新增工項
                    </a>
                </th>
            </tr>
        </tfoot>
    </table>
@stop
