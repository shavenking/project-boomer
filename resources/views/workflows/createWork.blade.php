{{-- */ $breadcrumbs = [
    trans('all.settings') => route('settings.index'),
    trans_choice('all.workflows', 2) => route('workflows.index'),
    "{$workflow->name}" => route('workflows.show', $workflow->id),
    '新增工項' => null
] /* --}}

@extends('layouts.settings')

@section('content')
    <div class="ui raised segment">
        <form class="ui form" action="{{ route('workflows.storeWork', $workflow->id) }}" method="POST">
            {{ csrf_field() }}

            <div class="field">
                <label>工作流程</label>
                <input type="text" value="{{ $workflow->name }}" disabled="disabled" title="工作流程">
            </div>

            <div class="field">
                <label>工作項目名稱</label>
                <input type="text" name="name" title="工作項目名稱">
            </div>

            <div class="field">
                <label>{{ trans('all.select_unit') }}</label>
                <unit-select></unit-select>
            </div>

            <div class="field">
                <label>選擇工程類別</label>
                <mainflow-type-select></mainflow-type-select>
            </div>

            <button class="ui primary button" type="submit">{{ trans('all.create') }}</button>
            <a href="{{ route('workflows.works', $workflow->id) }}" class="ui primary button">{{ trans('all.back') }}</a>
        </form>
    </div>

@stop
