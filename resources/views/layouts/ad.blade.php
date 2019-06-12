<?php $hide = true; ?>
@extends('layouts.layout')
@section('title', 'YJournal - объявления в Ялте')
@section('css')
    <link rel="stylesheet" href="{{asset('css/ad.css')}}">
    <link rel="stylesheet" href="{{asset("css/zoom.css")}}">
@endsection
@section('content')

    <div class="row">
        <div class="col m3 hide-on-med-and-down">
            @widget('categoryWidget')
        </div>

        <div class="col m9 s12 my">
            @yield('ad')
        </div>
    </div>

    <div class="fixed-action-btn direction-top" style="right: 24px;">
        <a class="btn-floating btn-large btn-color">
            <i class="material-icons">menu</i>
        </a>
        <ul>
            <li>
                <a href="{{route('ads.create')}}" class="btn-floating blue" style="opacity: 0; transform: scale(0.4) translateY(40px) translateX(0px);">
                    <i class="material-icons">add</i>
                </a>
            </li>
            {{--<li>--}}
            {{--<a class="btn-floating yellow darken-1" style="opacity: 0; transform: scale(0.4) translateY(40px) translateX(0px);">--}}
            {{--<i class="material-icons">format_quote</i>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<a class="btn-floating green" style="opacity: 0; transform: scale(0.4) translateY(40px) translateX(0px);">--}}
            {{--<i class="material-icons">publish</i>--}}
            {{--</a>--}}
            {{--</li>--}}
            <li>
                <a class="btn-floating sidenav-trigger yellow" data-target="nav-mobile1" style="opacity: 0; transform: scale(0.4) translateY(40px) translateX(0px);">
                    <i class="material-icons">arrow_forward</i>
                </a>
            </li>
        </ul>
    </div>
@endsection
