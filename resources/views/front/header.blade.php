
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@section('title') {{ Helpers::get_option('company_name') }} @show</title>

    <!-- core CSS -->
    <link href="{{ asset('assets/front') }}/css/bootstrap.min.css" rel="stylesheet">
    {{--<link href="{{ asset('assets/front') }}/css/bootstrap-theme.min.css" rel="stylesheet">--}}
    <link href="{{ asset('assets/front') }}/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('assets/front') }}/css/animate.min.css" rel="stylesheet">
    <link href="{{ asset('assets/front') }}/css/prettyPhoto.css" rel="stylesheet">
    <link href="{{ asset('assets/front') }}/css/main.css" rel="stylesheet">
    <link href="{{ asset('assets/front') }}/css/responsive.css" rel="stylesheet">

    @yield('page-css')
    <!--[if lt IE 9]>
    <script src="{{ asset('assets/front') }}/js/html5shiv.js"></script>
    <script src="{{ asset('assets/front') }}/js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body class="homepage">

<header id="header">
    <div class="top-bar">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-xs-4">
                    <div class="top-number"><p><i class="fa fa-phone-square"></i>  +0123 456 70 90</p></div>
                </div>
                <div class="col-sm-6 col-xs-8">
                    <div class="social">
                        <ul class="social-share">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-skype"></i></a></li>
                        </ul>

                        <div class="signinLink">
                            @if(Auth::check())
                                <a href="{{ route('user_logout') }}">Log Out</a>
                            @else
                                <a href="{{ route('sign_in') }}">Sign In</a> or
                                <a href="{{ route('user_signup') }}">Register new</a>
                            @endif
                        </div>

                       {{-- <div class="search">
                            <form role="form">
                                <input type="text" class="search-form" autocomplete="off" placeholder="Search">
                                <i class="fa fa-search"></i>
                            </form>
                        </div>--}}
                    </div>
                </div>
            </div>
        </div><!--/.container-->
    </div><!--/.top-bar-->

    <nav class="navbar navbar-inverse" role="banner">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('home') }}">Buzzrefer</a>
            </div>

            <div class="collapse navbar-collapse navbar-right">
                <ul class="nav navbar-nav">
                    <li class="{{ Request::is('/')? 'active' : ''  }}"><a href="{{ route('home') }}">Home</a></li>
                    <li class="{{ Request::is('shop-signup')? 'active' : ''  }}"><a href="about-us.html">About Us</a></li>
                    <li><a href="javascript:;">Services</a></li>
                    <li><a href="{{ route('shop') }}">Merchants</a></li>
                    <li><a href="{{ route('shop_signup') }}">Merchant Signup</a></li>
                    <li><a href="javascript:;">Contact</a></li>
                </ul>
            </div>
        </div><!--/.container-->
    </nav><!--/nav-->

</header><!--/header-->
