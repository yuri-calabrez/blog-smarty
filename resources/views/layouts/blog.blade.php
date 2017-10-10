<!DOCTYPE html>
<!--[if IE 8]>
<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>
<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->
<html> <!--<![endif]-->
<head>
    <meta charset="utf-8"/>
    <title>Seu site</title>
    <meta name="keywords" content="HTML5,CSS3,Template"/>
    <meta name="description" content=""/>
    <meta name="Author" content="Dorin Grigoras [www.stepofweb.com]"/>

    <!-- mobile settings -->
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0"/>
    <!--[if IE]>
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->

    <!-- WEB FONTS : use %7C instead of | (pipe) -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400%7CRaleway:300,400,500,600,700%7CLato:300,400,400italic,600,700"
          rel="stylesheet" type="text/css"/>

    <!-- CORE CSS -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet"/>

    <!-- THEME CSS -->
    <link href="{{asset('css/smarty/essentials.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/smarty/layout.css')}}" rel="stylesheet"/>

    <!-- PAGE LEVEL SCRIPTS -->
    <link href="{{asset('css/smarty/header-1.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/smarty/darkblue.css')}}" rel="stylesheet" id="color_scheme"/>

</head>

<body class="smoothscroll enable-animation">
<div id="wrapper">
    <div id="header" class="sticky clearfix">

        <!-- TOP NAV -->
        <header id="topNav">
            <div class="container">

                <!-- Mobile Menu Button -->
                <button class="btn btn-mobile" data-toggle="collapse" data-target=".nav-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="logo pull-left" href="index.html">
                    <img src="{{asset('images/logo.jpg')}}" alt="Logo"/>
                </a>
                <div class="navbar-collapse pull-right nav-main-collapse collapse">
                    <nav class="nav-main">
                        <ul id="topMain" class="nav nav-pills nav-main">
                            <li class="active"><!-- HOME -->
                                <a href="index.html">
                                    Home
                                </a>
                            </li>
                            <li><!-- PAGES -->
                                <a href="clientes.html">
                                    MENU
                                </a>
                            </li>
                            <li><!-- FEATURES -->
                                <a href="associado.html">
                                    MENU
                                </a>
                            </li>
                            <li><!-- PORTFOLIO -->
                                <a href="cursos.html">
                                    MENU
                                </a>
                            </li>
                            <li><!-- BLOG -->
                                <a href="consultoria.html">
                                   MENU
                                </a>
                            </li>
                            <li><!-- SHOP -->
                                <a href="servicos.html">
                                    Login
                                </a>
                            </li>
                        </ul>

                    </nav>
                </div>

            </div>
        </header>
        <!-- /Top Nav -->

    </div>
</div>
</body>
</html>
