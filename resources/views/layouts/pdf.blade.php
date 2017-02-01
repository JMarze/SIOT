<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Registro de Delimitación</title>

    <style>
        table{
            font-size: x-small;
        }
        table.content{
            margin-bottom: 10px;
        }
        table.content td,
        table.content th{
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <header>
        <table style="width:100%;">
            <tr>
                <th style="width:15%;">
                    <img src="img/escudo_bolivia.jpg" alt="Escudo de Bolivia"/>
                </th>
                <th style="width:70%;"></th>
                <th style="width:15%;">
                    <img src="img/min_autonomias.jpg" alt="Ministerio de Autonomías"/>
                </th>
            </tr>
        </table>
    </header>

    <h3 style="text-align:center;">@yield('title')</h3>

    @yield('content')
</body>

</html>
