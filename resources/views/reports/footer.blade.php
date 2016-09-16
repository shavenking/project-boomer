<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/css/bootstrap.min.css" integrity="sha384-2hfp1SzUoho7/TsGGGDaFdsuuDL0LX2hnUp6VkX3CUQ2K4K+xjboZdsXyp4oUHZj" crossorigin="anonymous">
    <style>
        * {
            font-family: 'cwTeXKai' !important;
            font-style: normal;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-6">
                <p>廠商（印）</p>
            </div>
            <div class="col-xs-6">
                <p>負責人（印）</p>
            </div>
        </div>
    </div>
    <script>
        (function () {
            var vars={};
            var x=window.location.search.substring(1).split('&');
            for (var i in x) {var z=x[i].split('=',2);vars[z[0]] = unescape(z[1]);}
            var x=['frompage','topage','page','webpage','section','subsection','subsubsection'];
            for (var i in x) {
                var y = document.getElementsByClassName(x[i]);
                for (var j=0; j<y.length; ++j) y[j].textContent = vars[x[i]];
            }
        })();
    </script>
</body>
</html>

