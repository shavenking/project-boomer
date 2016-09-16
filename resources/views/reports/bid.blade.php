<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>標單</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/css/bootstrap.min.css" integrity="sha384-2hfp1SzUoho7/TsGGGDaFdsuuDL0LX2hnUp6VkX3CUQ2K4K+xjboZdsXyp4oUHZj" crossorigin="anonymous">
    <style>
        * {
            font-family: 'cwTeXKai';
            font-style: normal;
        }
        table, tr, td, th, tbody, thead, tfoot {
            page-break-inside: avoid !important;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>工程類別、順序</th>
                            <th>工作項目</th>
                            <th>單位</th>
                            <th>單價</th>
                            <th>數量</th>
                            <th>總價</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($works as $work)
                            <tr>
                                <td>
                                    {{ $work->detailingflowType->mainflowType->name }}<br>
                                    {{ $work->detailingflowType->name }}
                                </td>
                                <td>{{ $work->name }}</td>
                                <td>{{ $work->unit->name }}</td>
                                <td>{{ $work->unit_price }}</td>
                                <td>{{ $work->amount }}</td>
                                <td>{{ $work->amount * $work->unit_price }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
