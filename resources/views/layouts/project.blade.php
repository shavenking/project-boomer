<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>@include('components.title')</title>
    <link rel="stylesheet" href="/css/semantic.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.6/compressed/themes/classic.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.6/compressed/themes/classic.date.css">
</head>
<body>
    <div class="ui stackable grid container">

        <div class="sixteen wide column">
            @include('components.navbar')
        </div>

        <div class="four wide computer only column">
            @include('components.project-sidebar')
        </div>

        <div class="sixteen wide mobile only column">
            <modal-project-menu>
                @include('components.project-sidebar')
            </modal-project-menu>
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
