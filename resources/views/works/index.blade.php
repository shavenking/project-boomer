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
    @if (count($works))
        <div class="ui two column grid">
            @foreach ($works as $work)
                <div class="column">
                    @include('works._card', $work)
                </div>
            @endforeach
        </div>
    @else
        <p>目前沒有工項，請 <a href="{{ route('works.create') }}">點我</a> 新增</p>
    @endif
@stop
