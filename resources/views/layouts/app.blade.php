<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SIOT - Sistema de Información para la Organización Territorial</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <link rel="stylesheet" type="text/css" href="css/validado_min.css">
    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default jquerybanner">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    SIOT
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Inicio</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Iniciar Sesión</a></li>
                        <li><a href="{{ url('/register') }}">Regístrese</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Cerrar Sesión</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <ul class="nav nav-pills">
                     <li role="presentation" class="dropdown">
                        <a class="dropdown-toggle jqueryslidemenu" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            Etapa de Inicio <span class="caret"></span>
                        </a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Llenar solicitud</a></li>
                                <li><a href="#">Revision tecnica</a></li>
                            </ul>
                    </li>
                    <li role="presentation" class="dropdown">
                        <a class="dropdown-toggle jqueryslidemenu" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            Etapa de Ejecucion en Campo<span class="caret"></span>
                        </a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Acta de Apertura</a></li>
                            </ul>
                    </li>
                    <li role="presentation" class="dropdown">
                        <a class="dropdown-toggle jqueryslidemenu" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            Etapa Final del Procedimiento<span class="caret"></span>
                        </a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Remision de Acta</a></li>
                                <li><a href="#">Informe Tecnico</a></li>
                                <li><a href="#">Informe Legal</a></li>
                            </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
