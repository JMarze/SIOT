<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SIOT - Sistema de Información de Organización Territorial</title>

    <!-- Local -->
    {!! Html::style('css/style.css') !!}

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css' />
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css' />

    <!-- Styles -->
    {!! Html::style('css/bootstrap.min.css') !!}
    {!! Html::style('css/bootstrap-theme.min.css') !!}

    <!-- Select2 -->
    {!! Html::style('css/select2.min.css') !!}
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

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

    <div class="container">

        <div class="panel panel-default" style="margin-bottom:0px;">
            <div class="panel-body">
                <div class="col-md-2 text-center">
                    <img src="{{ asset('img/escudo_bolivia.jpg') }}" alt="Escudo de Bolivia"/>
                </div>
                <div class="col-md-8 text-center">
                    <h1>Sistema de Información de Organización Territorial</h1>
                </div>
                <div class="col-md-2 text-center">
                    <img src="{{ asset('img/min_autonomias.jpg') }}" alt="Ministerio de Autonomías"/>
                </div>
            </div>
        </div>

        <nav class="navbar navbar-default">
            <div class="navbar-header">
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav navbar-left" style="margin-left:-15px;">
                    <li>
                        <a href="{{ url('/') }}">
                            <i class="fa fa-btn fa-home"></i>Inicio
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Etapa de Inicio <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('solicitud.index') }}"><i class="fa fa-btn fa-map-marker"></i>Solicitudes</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#">Etapa de Campo</a></li>
                    <li><a href="#">Etapa de Final</a></li>
                    <li><a href="#">Demarcación</a></li>
                    <li><a href="#">Ley</a></li>
                    <li><a href="http://200.87.131.174:8080/geonetwork" target="_blank">Geonetwork</a></li>
                    <li><a href="http://200.87.131.174:8080/geoserver" target="_blank">Geoserver</a></li>
                    <li><a href="http://200.87.131.174:8080/mapfishapp/?noheader=true" target="_blank">Visualizador</a></li>
                </ul>


                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Iniciar Sesión</a></li>
                    @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            @if(Auth::user()->role == 'admin')
                            <li><a href="{{ url('/register') }}">Regístrar</a></li>
                            @endif
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Cerrar Sesión</a></li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>
        </nav>
    </div>

    <div class="container">
        @include('flash::message')
    </div>

    @yield('content')

    <!-- JavaScripts -->
    {!! Html::script('js/jquery.min.js') !!}
    {!! Html::script('js/bootstrap.min.js') !!}

    <!-- Select2 -->
    {!! Html::script('js/select2.min.js') !!}

    <!-- JQuery Form -->
    {!! Html::script('js/jquery.form.js') !!}
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

    @yield('script')
</body>
</html>
