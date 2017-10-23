<!DOCTYPE html>
<!--[if IE 8]>
<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>
<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->
<html lang="{{ app()->getLocale() }}"> <!--<![endif]-->
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
    <script src="https://use.fontawesome.com/39a18de4f3.js"></script>

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
                    <a class="logo pull-left" href="{{route('blog.index')}}">
                        <img src="{{asset('images/logo.jpg')}}" alt="Logo"/>
                    </a>
                    <div class="navbar-collapse pull-right nav-main-collapse collapse">
                        <nav class="nav-main">
                            <ul id="topMain" class="nav nav-pills nav-main">
                                <li class="active"><!-- HOME -->
                                    <a href="{{route('blog.index')}}">
                                        Home
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('login')}}">
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

        <main id="app">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 col-sm-9 margin-top-30">
                        @yield('content')
                    </div>

                    <div class="col-md-3 col-sm-3 margin-top-30">
                        @include('blog.right-aside')
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script type="text/javascript">var plugin_path = 'vendor/';</script>
    <script type="text/javascript" src="{{asset('vendor/jquery/jquery-2.2.3.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendor/scripts.js')}}"></script>
</body>
</html>
