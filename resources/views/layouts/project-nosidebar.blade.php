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

        <div class="sixteen wide column">
            <div class="ui fluid three item pointing menu">
                <a class="item">內部作業</a>
                <a class="item">外部作業</a>
                <a class="item">財務管理</a>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/react/0.14.3/react.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/react/0.14.3/react-dom.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.23/browser.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.6/semantic.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/3.10.1/lodash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/classnames/2.2.0/index.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.4/raphael-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowchart/1.4.2/flowchart.min.js"></script>

    @yield('react.components')

</body>
</html>
