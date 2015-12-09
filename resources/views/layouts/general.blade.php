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
                @yield('navbar')
            </div>
        </div>

        <div class="four wide column">
            <div class="ui vertical pointing menu">
                @yield('sidebar')
            </div>
        </div>

        <div class="twelve wide column">

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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.6/semantic.min.js"></script>
</body>
</html>
