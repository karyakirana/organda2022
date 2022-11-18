<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print</title>
    <link rel="stylesheet" href="{{ public_path('css\bootstrap.css') }}" media="all" />
    <style>
        .table, th, td{
            border-color: #0b0b10!important;
            font-size: 14pt;
            padding: 10px!important;
        }

        th{
            vertical-align: middle;
            text-align: justify;
        }
    </style>
</head>
<body>
    <table class="table table-bordered">
        <thead>
            <tr class="border-1">
                <th width="10%" class="text-center">No</th>
                <th width="40%" class="text-center">Customer</th>
                <th width="12.5%" class="text-center">BAT</th>
                <th width="12.5%" class="text-center">Teluk Lamong</th>
                <th width="12.5%" class="text-center">STID</th>
                <th width="12.5%" class="text-center">MyPertamina</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
                <tr>
                    <td class="text-center">{{$loop->iteration}}</td>
                    <td>{{$row->nama_cust}}</td>
                    <td class="text-center">{{$row->yoman}}</td>
                    <td class="text-center">{{$row->lamong}}</td>
                    <td class="text-center">{{$row->sum_stid}}</td>
                    <td class="text-center">{{$row->sum_mypertamina}}</td>
                </tr>
            @endforeach
            <tr>
            <tr>
                <td colspan="2"></td>
                <td align="center">{{$data->sum('yoman')}}</td>
                <td align="center">{{$data->sum('lamong')}}</td>
                <td align="center">{{$data->sum('sum_stid')}}</td>
                <td align="center">{{$data->sum('sum_mypertamina')}}</td>
            </tr>
            </tr>
        </tbody>
    </table>
</body>
</html>
