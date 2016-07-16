<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/semantic.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.6/compressed/themes/classic.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.6/compressed/themes/classic.date.css">
</head>
<body>
    <div class="ui stackable grid container">
        <div class="sixteen wide column">
            <div class="ui borderless inverted menu">

                <a href="{{ route('index') }}" class="header item">
                    {{ trans('all.system_name') }}
                </a>

                <div class="right menu">
                    <a href="{{ route('auth.get.register') }}" class="@if (request()->is('*register*')) active @endif item">
                        註冊
                    </a>
                    <a href="{{ route('auth.get.login') }}" class="@if (request()->is('*login*')) active @endif item">
                        登入
                    </a>
                </div>

            </div>
        </div>

        <div class="sixteen wide column">
            @yield('content')
        </div>
    </div>
</body>
</html>
