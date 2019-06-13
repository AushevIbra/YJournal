<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="{{ asset('assets/css/materialize.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="{{ asset('assets/css/style.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="{{ asset('/css/main.css') }}" type="text/css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('fonts/stylesheet.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/brands.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/fontawesome.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/solid.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/dropzone.css')}}">

    <!-- Meta Zone -->
    <meta name="robots" content="index, follow, all">
    <meta name="geo.placename" content="@yield('title')">
    <meta name="geo.region" content="RU">
    <meta name="google" content="notranslate">

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="@yield('title')">
    <meta name="theme-color" content="#2a2a2a"/>

    <meta property="og:site_name" content="@yield('title')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{"https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"}}">
    <meta property="og:locale" content="ru_RU">
    <meta property="og:type" content="website">

    <meta name="description" content="@yield('description')">
    <meta property="og:title" content="@yield('title')">
    <meta property="image" content="@yield('main_img')"> <!-- VK -->
    <meta property="og:image" content="@yield('main_img')"> <!-- FB -->
    <meta property="og:description" content="@yield('description')">

    <meta name="twitter:image" content="@yield('main_img')"> <!-- Twitter -->
    <meta name="twitter:title" content="@yield('title')">
    <meta name="twitter:description" content="@yield('description')">


    @yield('css')
</head>
<body>
@auth
    @include('components.dropdown-user')
@endauth
<nav class="nav-color sticky" role="navigation">
    <div class="nav-wrapper ">

        <ul class="d-flex">
            <li>
                <a href="/" class="brand-logo">
                    {{--<img src="{{asset('/imgs/logo.svg')}}" alt="">--}}
                    YJournal
                </a>
            </li>
            <div class="hide-on-med-and-down">
                @if(\Illuminate\Support\Facades\Auth::guest())
                    <li><a class="light" data-id="login" href="javascript:;">Войти</a></li>
                    <li class="light {{ request()->is('asks*') ? 'active' : '' }}"><a href="{{route('asks.index')}}">Вопросы / Ответы</a></li>
                    <li class="light {{ request()->is('board*') || request()->is('ads*') ? 'active' : '' }}"><a href="{{route('board')}}">Объявления</a></li>
                    <li class="light {{ request()->is('about') ? 'active' : '' }}"><a href="{{route('about')}}">О проекте</a></li>

                @else

                    <li class="light {{ request()->is('post/create') ? 'active' : '' }}"><a href="{{route('post.create')}}">Написать</a></li>
                    <li class="light {{ request()->is('board*') || request()->is('ads*') ? 'active' : '' }}"><a href="{{route('board')}}">Объявления</a></li>
                    <li class="light {{ request()->is('asks*') ? 'active' : '' }}"><a href="{{route('asks.index')}}">Вопросы / Ответы</a></li>
                    <li class="light {{ request()->is('about') ? 'active' : '' }}"><a href="{{route('about')}}">О проекте</a></li>
                    <li id="notification" class="center-block" style="width: 150px;"></li>
                    <li class="header-avatar">
                        <img src="{{Auth::user()->avatar}}" data-dropdown-profile="123"/>
                        <div class="dropdown-profile wb">
                            <a class="bl" href="{{route('user.profile', auth()->user()->id)}}">Профиль</a>
                            <a class="bl" href="{{route('user.setting')}}">Настройки</a>
                            <a class="bl" href="{{route('logout')}}">Выход</a>
                        </div>
                    </li>

                @endif
            </div>
        </ul>

        <ul id="nav-mobile" class="sidenav">
            <li class="light {{ request()->is('/') ? 'active' : '' }}"><a href="{{route('index')}}">Главная</a></li>
        @guest
                <li><a class="light" data-id="login" href="javascript:;">Войти</a></li>
                <li class="light {{ request()->is('board*') || request()->is('ads*') ? 'active' : '' }}"><a href="{{route('board')}}">Объявления</a></li>
                <li class="light {{ request()->is('asks*') ? 'active' : '' }}"><a href="{{route('asks.index')}}">Вопросы / Ответы</a></li>
                <li class="light {{ request()->is('about') ? 'active' : '' }}"><a href="{{route('about')}}">О проекте</a></li>
            @else
                <ul class="collapsible black-text">
                    <li>
                        <div class="collapsible-header"><i class="material-icons">person</i>Профиль</div>

                        <div class="collapsible-body">
                            <ul class="collection">
                                <li class="collection-item"><a href="{{route("user.profile", Auth::user()->id)}}">Мой профиль</a></li>
                                <li class="collection-item"><a href="{{route("user.profile", Auth::user()->id)}}">Настройки</a></li>
                                <li class="collection-item"><a href="{{route("logout")}}">Выйти</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="light {{ request()->is('board*') || request()->is('ads*') ? 'active' : '' }}"><a href="{{route('board')}}">Объявления</a></li>
                    <li class="{{ request()->is('asks*') ? 'active' : '' }}"><a href="{{route('asks.index')}}">Вопросы / Ответы</a></li>
                    <li class="light {{ request()->is('about') ? 'active' : '' }}"><a href="{{route('about')}}">О проекте</a></li>


                </ul>
            @endguest


        </ul>
        <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    </div>
</nav>


<main>

    <div class="container">
        <div class="section">
            @yield('content')
        </div>
    </div>
    @if(! isset($hide))
        <div class="fixed-action-btn {{!isset($route) ? 'hide-on-med-and-down' : null }}">
            <a class="btn-floating btn-large btn-color" href="{{isset($route)  ? route($route): route('post.create')}}">
                <i class="large material-icons">mode_edit</i>
            </a>
        </div>
    @endif
</main>


<div id="react-bottom-nav"></div>
@yield('footer')

@if(\Illuminate\Support\Facades\Auth::guest())
    @include('auth.ulogin')
@endif


<!--  Scripts-->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="{{ asset('assets/js/materialize.js') }}"></script>
<script src="{{asset('js/dropzone.js')}}"></script>

<script>

    $(function () {
        $('[data-dropdown-profile]').on('click', function () {
            if ($('.dropdown-profile.wb.active').length == 0) {
                $('.dropdown-profile').addClass('active')
            } else {
                $('.dropdown-profile').removeClass('active')
                document.addEventListener('click', () => {
                    window.$(document).mouseup(function (e) { // событие клика по веб-документу
                        var div = $(".header-avatar"); // тут указываем ID элемента
                        if (!div.is(e.target) // если клик был не по нашему блоку
                            && div.has(e.target).length === 0) { // и не по его дочерним элементам
                            $('.dropdown-profile').removeClass('active')
                        }
                    });
                }, false);
            }

        })
        $('.sidenav').sidenav();
        $('.modal').modal();
        $(".dropdown-trigger").dropdown();
        $('.collapsible').collapsible();
        $('.fixed-action-btn').floatingActionButton({
            // direction: 'left',
            hoverEnabled: false
        });

        // $(".owl-carousel").owlCarousel();
        // $('.fixed-action-btn').floatingActionButton({
        //     direction: 'left',
        //     hoverEnabled: false
        // });

    }); // end of document ready

</script>
<script src="{{ asset('/js/app.js')}}"></script>
<script src="{{ asset('/js/ion.js') }}"></script>
<script src="{{ asset('/assets/js/main.js') }}"></script>
<script src="{{asset('/js/jquery.sticky.js')}}"></script>

@yield('js')

<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
    m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");
 
    ym(54042265, "init", {
         clickmap:true,
         trackLinks:true,
         accurateTrackBounce:true,
         webvisor:true
    });
 </script>
 <noscript><div><img src="https://mc.yandex.ru/watch/54042265" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
 <!-- /Yandex.Metrika counter -->

</body>
</html>
