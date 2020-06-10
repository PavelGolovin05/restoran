@include('layouts.app')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="favicon.png">

    <title>Ахметовская Гумманитарка</title>

    <link href="/bootstrap3/css/bootstrap.css" rel="stylesheet">


    <link href="/css/main.css" rel="stylesheet">

    <link href="/css/responsive.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css" />

    <link rel="stylesheet" type="text/css" href="/css/btn.css" />

    <link rel="stylesheet" type="text/css" href="/css/superfish/superfish.css" />

    <link href="/js/theme-color-selector/theme-color-selector.css" type="text/css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="/js/owl-carousel/owl.carousel.css" />

    <link rel="stylesheet" type="text/css" href="/css/twitterfeed.css" />

    <link rel="stylesheet" type="text/css" href="/css/typicons/typicons.min.css" />

    <link rel="stylesheet" type="text/css" href="/js/wow/css/libs/animate.css" />

    <link rel="stylesheet" type="text/css" href="/css/forms.css" />

    <link rel="stylesheet" type="text/css" href="/css/flickrfeed.css" />

    <link href='http://fonts.googleapis.com/css?family=Cantata+One%7COpen+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>

</head>

<body>
@section('content')
    @endsection()
<div id="pm_layout_wrapper" class="pm-full-mode"><!-- Use wrapper for wide or boxed mode -->
    <!-- Main navigation -->
    <header>

        <div class="container">

            <div class="row">

                <div class="col-lg-4 col-md-4 col-sm-12">

                    <div class="pm-header-logo-container">
                        <a href="/main" style="font-size: 18pt;">Ахметовская Гумманитарка</a>
                    </div>

                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 pm-main-menu">

                    <nav class="navbar-collapse collapse ">

                        <ul class="sf-menu pm-nav" style="width: 1400px; margin-top:50px;">

                            <li>
                                <a href="/main" style="font-size: 14pt;">Главная</a>
                            </li>
                            <li>
                                <a href="/dishes/alldishes" style="font-size: 14pt;">Меню</a>
                            </li>
                            <li>
                                <a href="/reservations/index" style="font-size: 14pt;">Бронирование</a>
                            </li>
                            <li>
                                <a href="/events/index" style="font-size: 14pt;">Мероприятия</a>
                            </li>
                            <li>
                                <a href="/stat" style="font-size: 14pt;">Статистика</a>
                            </li>
                            <li>
                                <a href="/about" style="font-size: 14pt;">О нас</a>
                            </li>
                            <li>
                                <a href="/halls/index" style="font-size: 14pt;">Залы</a>
                            </li>
                            @auth()
                            @if(Auth::user()->is_admin == 1)
                                <li>
                                    <a href="/admin/index" style="font-size: 14pt;">Работа с данными</a>
                                </li>
                            @endif
                            @endauth
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- /Main navigation -->

    <!-- SUB-HEADER area -->
    <div class="pm-sub-header-container pm-parallax-panel" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="0">

        <div class="pm-sub-header-title-container">
            <p class="pm-sub-header-title"><span>О нас</span></p>
            <p class="pm-sub-header-message">Ахметовская гречка лучшая!</p>
        </div>

    </div>

    <!-- SUB-HEADER area end -->

    <!-- BODY CONTENT starts here -->

    <!-- Menu filter system -->
    <div class="container pm-containerPadding80">


        <div class="about">
            <img src="/img/Карта.png" alt="">
        </div>
        <div class="about">
            <p>Адрес: Донецк, Донбасс Арена</p>
            <p>Телефон: 071-1111-11-11</p>
            <p>Почта: <a href="mailto:pasha.golovin.don@gmail.com">pasha.golovin.don@gmail.com</a></p>
        </div>
    </div>
</div>
<!-- Menu filter system end -->

<!-- BODY CONTENT end -->



<div class="pm-footer-copyright">

    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12 pm-footer-copyright-col">
                <p> Ахметовская Гумманитарка</p>
            </div>

        </div>
    </div>

</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery-2.1.1.min.js"></script>
<script src="js/jquery.viewport.mini.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="bootstrap3/js/bootstrap.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<script src="js/owl-carousel/owl.carousel.js"></script>
<script src="js/main.js"></script>
<script src="js/jquery.tooltip.js"></script>
<script src="js/jquery.hoverPanel.js"></script>
<script src="js/superfish/superfish.js"></script>
<script src="js/superfish/hoverIntent.js"></script>
<script src="js/tinynav.js"></script>
<script src="js/stellar/jquery.stellar.js"></script>
<script src="js/countdown/countdown.js"></script>
<script src="js/theme-color-selector/theme-color-selector.js"></script>
<script src="js/wow/wow.min.js"></script>
<script src="js/pulse/jquery.PMSlider.js"></script>

<p id="back-top" class="visible-lg visible-md visible-sm"> </p>

</body>
</html>




