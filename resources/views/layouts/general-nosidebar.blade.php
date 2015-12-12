<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.6/semantic.min.css">
</head>
<body>
    <div class="ui grid container">

        <div class="sixteen wide column">
            <div class="ui pointing inverted large menu">
                @include('partials.navbar')
            </div>
        </div>

        <div class="sixteen wide column">

            <div class="ui grid">

                <div class="sixteen wide column">
                    <div class="ui large breadcrumb">
                        <i class="sitemap icon"></i>
                        @yield('breadcrumbs')
                    </div>
                </div>

                <div class="sixteen wide column">
                    @yield('content')
                </div>

            </div>

        </div>

    </div>

    <script src="/js/main.js"></script>

</body>
</html>
