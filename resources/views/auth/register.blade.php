@extends('layouts.auth')

@section('title')
註冊
@stop

@section('content')
    <section class="ui raised segment">
        <form method="POST" action="{{ route('auth.post.register') }}" class="ui form">
            {{ csrf_field() }}
            <div class="field">
                <label>名稱</label>
                <input type="text" name="name" value="{{ old('name') }}">
            </div>
            <div class="field">
                <label>信箱</label>
                <input type="text" name="email" value="{{ old('email') }}">
            </div>
            <div class="field">
                <label>密碼</label>
                <input type="password" name="password">
            </div>
            <div class="field">
                <label>確認密碼</label>
                <input type="password" name="password_confirmation">
            </div>

            <button class="ui primary button" type="submit">送出</button>
        </form>
    </section>
@stop
