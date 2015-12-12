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
            <div class="ui fluid three item pointing menu">
                <a href="#" class="item">內部作業</a>
                <a href="#" class="item">外部作業</a>
                <a href="#" class="item">財務管理</a>
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

    @include('partials.js-libs')

    @yield('react.components')

</body>
</html>