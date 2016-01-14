{{-- */ $breadcrumbs = [
    'Settings' => route('settings.index'),
    'Checklists' => route('checklists.index'),
    "{$checklist->name}" => null
] /* --}}

@extends('layouts.settings')

@section('content')

    <div class="ui secondary pointing menu">
        <a href="{{ route('checklists.show', $checklist->id) }}" class="active item">{{ $checklist->name }}</a>
        <a href="{{ route('checklists.workflow', $checklist->id) }}" class="item">Workflow</a>
        <a href="{{ route('checklists.works', $checklist->id) }}" class="item">Works</a>
    </div>

    <div class="ui raised segment">
        <h4 class="ui header">
            Check Items
            @if ($checklist->checkitems->isEmpty())
                <div class="sub header">You don't have any check items yet!</div>
            @endif
        </h4>
        @if (!$checklist->checkitems->isEmpty())
            <div class="ui ordered list">
                @foreach ($checklist->checkitems as $checkitem)
                    <div class="item">
                        <div class="content">
                            <div class="header">{{ $checkitem->name }}</div>
                            <div class="description">{{ $checkitem->detail }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <div class="ui segment">
        <h4 class="ui dividing header">Add Check Item</h4>

        <form action="{{ route('checklists.checkitems.store', $checklist->id) }}" method="POST" class="ui form">
            {{ csrf_field() }}

            <div class="field">
                <label>Name</label>
                <input type="text" name="name">
            </div>

            <div class="field">
                <label>Detail</label>
                <input type="text" name="detail">
            </div>

            <button class="ui primary button" type="submit">Submit</button>
        </form>

    </div>
@stop
