@extends('layouts.auth')

@section('title')
登入
@stop

@section('content')
    <section class="ui raised segment">
        <form method="POST" action="{{ route('auth.post.login') }}" class="ui form">
            {{ csrf_field() }}
            <div class="field">
                <label>信箱</label>
                <input type="text" name="email" value="{{ old('email') }}">
            </div>
            <div class="field">
                <label>密碼</label>
                <input type="password" name="password">
            </div>
            <div class="field">
                <input type="hidden" name="remember" value="true" tabindex="0">
            </div>

            <button class="ui primary button" type="submit">送出</button>
        </form>
    </section>
@stop
