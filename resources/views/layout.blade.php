<!DOCTYPE html> 
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Madera') }}</title>
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
        <link rel="icon" href="img/favicon.ico" type="image/x-icon">
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel="stylesheet"  type="text/css" href="<?=url('/css/bootstrap.min.css');?>">
        <link rel="stylesheet"  type="text/css" href="<?=url('/css/regular.css');?>">
        <link href="<?=url('/css/fontawesome.min.css');?>" rel="stylesheet" type="text/css">
        <link rel="stylesheet"  type="text/css" href="<?=url('/css/dataTables.bootstrap4.min.css');?>">
        <link rel="stylesheet"  type="text/css" href="<?=url('/css/app.css');?>">
    </head>
    <body id="page-top">
        <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
            <a class="navbar-brand mr-1" href="/"><img src="<?=url('img/logo.png');?>" class="img-fluid w-10" style="width:120px;" /></a>
            <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
            <i class="fas fa-bars"></i>
            </button>
            <ul class="navbar-nav ml-auto ">
            @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Connexion') }}</a>
            </li>
            @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Inscription') }}</a>
            </li>
            @endif
            @else
            

            
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user-circle fa-fw"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">Mon compte</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                        {{ __('Déconnexion') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
            </ul>
        </nav>
        <div id="wrapper">
            @guest
            @else

            @include('sidebar') 
            @endguest
            <div id="content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        @yield('content')
                        <!--@include('footer') -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END JS Files --> 
        <script type="text/javascript" src="<?=url('/js/jquery-3.3.1.min.js');?>"></script>
        <script type="text/javascript" src="<?=url('/js/popper.min.js');?>"></script>
        <script type="text/javascript" src="<?=url('/js/bootstrap.min.js');?>"></script>
        <script src="<?=url('/js/jquery.easing.min.js');?>"></script>
        <script src="<?=url('/js/Chart.min.js');?>"></script>
        <script src="<?=url('/js/jquery.dataTables.min.js');?>"></script>
        <script src="<?=url('/js/dataTables.bootstrap4.min.js');?>"></script>
        <script src="<?=url('/js/app.js');?>"></script>
    </body>
</html>
