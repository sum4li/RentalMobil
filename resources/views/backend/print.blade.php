<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <style>
        .header{
            display: flex;
            width: 100%;
            text-align: left;
            margin-bottom: 10px;
        }

        .main{
            display: block;
            width: 100%;
            text-align: center;
        }
        .footer{
            margin-top: 10px;
            display: block;
            width: 100%;
            text-align: center;
        }
        .table{
            border-collapse: collapse;
            width: 100%;
        }
        .table td, th {
            padding: .3rem;
        }
        .table thead th {
            vertical-align: bottom;
            border: 1px solid #333333;
        }
        .table td, .table th {
            padding: .3rem;
            vertical-align: top;
            border: 1px solid ##333333;
        }
        .table-borderless tbody + tbody, .table-borderless td, .table-borderless th, .table-borderless thead th {
            border: 0;
        }
    </style>

</head>

<body>
    @yield('content')
</body>
</html>
