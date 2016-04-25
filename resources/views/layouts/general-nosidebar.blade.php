<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>@include('components.title')</title>
    <link rel="stylesheet" href="/css/semantic.min.css">
</head>
<body>
    <div class="ui stackable grid container">
        <div class="sixteen wide column">
            @include('components.navbar')
        </div>

        <div class="sixteen wide column">
            @yield('content')
        </div>
    </div>

    @include('layouts._scripts')
</body>
</html>
