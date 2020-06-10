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

    <!-- main css -->
    <link href="/css/main.css" rel="stylesheet">

    <!-- mobile css -->
    <link href="/css/responsive.css" rel="stylesheet">

    <!-- FontAwesome Support -->
    <link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css" />
    <!-- FontAwesome Support -->

    <!-- Btns -->
    <link rel="stylesheet" type="text/css" href="/css/btn.css" />
    <!-- Btns -->

    <!-- Superfish menu -->
    <link rel="stylesheet" type="text/css" href="/css/superfish/superfish.css" />
    <!-- Superfish menu -->

    <!-- Theme Color selector -->
    <link href="/js/theme-color-selector/theme-color-selector.css" type="text/css" rel="stylesheet">
    <!-- Theme Color selector -->

    <!-- Owl Carousel -->
    <link rel="stylesheet" type="text/css" href="/js/owl-carousel/owl.carousel.css" />
    <!-- Owl Carousel -->

    <!-- Twitter feed -->
    <link rel="stylesheet" type="text/css" href="/css/twitterfeed.css" />
    <!-- Twitter feed -->

    <!-- Typicons -->
    <link rel="stylesheet" type="text/css" href="/css/typicons/typicons.min.css" />
    <!-- Typicons -->

    <!-- WOW animations -->
    <link rel="stylesheet" type="text/css" href="/js/wow/css/libs/animate.css" />
    <!-- WOW animations -->

    <!-- Forms -->
    <link rel="stylesheet" type="text/css" href="/css/forms.css" />
    <!-- Forms -->

    <!-- Flickr feed -->
    <link rel="stylesheet" type="text/css" href="/css/flickrfeed.css" />
    <!-- Flickr feed -->

    <!-- Development Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Cantata+One%7COpen+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
    <!-- Development Google Fonts -->

</head>

<body>
@section('content')
@endsection()

<div id="pm_layout_wrapper" class="pm-full-mode">

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

    <div class="pm-sub-header-container pm-parallax-panel" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="0">

        <div class="pm-sub-header-title-container">
            <p class="pm-sub-header-title"><span>Наше меню</span></p>
            <p class="pm-sub-header-message">Ахметовская гречка лучшая!</p>
        </div>

    </div>

    <div class="container pm-containerPadding80">
        <div class="row">

            <div class="col-lg-12 pm-containerPadding-bottom-40">

                <form action="{{ url('events/findDish/') }}">

                    <div class="pm-isotope-filter-container">
                        <ul class="pm-isotope-filter-system">
                            <li class="pm-isotope-filter-system-expand">Expand <i class="fa fa-angle-down"></i></li>

                            <table>
                                <tr>
                                    <td>
                                        <li>Категория:</li>
                                        <select name="category">
                                            <option value="0">Любая</option>
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <li>Ингредиенты</li>
                                        <select name="ingredient">
                                            <option value="0">Любой</option>
                                            @foreach ($ingredients as $ingredient)
                                                <option value="{{$ingredient->id}}">{{$ingredient->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <br>
                            <li>Название:
                                <input type="text" name="name" ></li>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="submit" value="Найти">
                            <br>
                            <br>
                        </ul>

                    </div>
                </form>
            </div>
        </div>
        @if (session()->has('message'))
            <div class="alert alert-info">
                {{ session('message') }}
            </div>
        @endif

                @foreach($dishes as $dish)
            <form action="/events/addDishes">
                <input type="hidden" name="event" value="{{$eventId}}">
                    <input type="hidden" name="dish" value="{{$dish->id}}">
                    <div class="col-lg-4 col-md-4 col-sm-6 pm-column-spacing">
                        <div class="pm-menu-item-container">
                            <div class="pm-menu-item-img-container" style="background-image:url('{{$dish->photo_link}}');">
                                <div class="pm-menu-item-price"><p>{{$dish->price}}р.</p></div>
                                <div class="pm-menu-item-weight"><p>{{$dish->weight}}{{$dish->measure}}</p></div>
                            </div>
                            <div class="pm-menu-item-desc">
                                <p class="pm-menu-item-title"><a href="{{ url('dishes/dish/' . $dish->id) }}">{{ $dish->name }}</a></p>
                                <p class="pm-menu-item-excerpt">{{$dish->description}} </p>
                            </div>
                        </div>
                        <p>Количество: <input type="text" name="count"  style="width: 128px;">&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Добавить"></p>
                    </div>
            </form>
                @endforeach

    </div>
</div>

<div class="pm-footer-copyright">

    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12 pm-footer-copyright-col">
                <p> Ахметовская Гумманитарка</p>
            </div>

        </div>
    </div>

</div>

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
