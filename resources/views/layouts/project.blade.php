<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@include('components.title')</title>
    <link rel="stylesheet" href="/css/semantic.min.css">
</head>
<body>
    <div class="ui grid container">

        <div class="sixteen wide column">
            @include('components.navbar')
        </div>

        <div class="four wide column">
            <div class="ui vertical menu">
                @include('components.project-sidebar')
            </div>
        </div>

        <div class="twelve wide column">

            <div class="ui grid">

                <div class="sixteen wide column">
                    <div class="ui large breadcrumb">
                        <i class="sitemap icon"></i>
                        @include('components.breadcrumbs')
                    </div>
                </div>

                <div class="sixteen wide column">
                    @yield('content')
                </div>

            </div>

        </div>

    </div>

    @include('layouts._scripts')

</body>
</html>
