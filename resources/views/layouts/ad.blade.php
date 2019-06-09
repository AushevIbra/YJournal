<?php $hide = true; ?>
@extends('layouts.layout')
@section('title', 'YJournal - объявления в Ялте')

@section('content')

    <div class="row">
        <div class="col m3">
            @widget('categoryWidget')
        </div>

        <div class="col m9">
            <a href="#" data-target="nav-mobile1" class="sidenav-trigger"><i class="material-icons">menu</i></a>

            @yield('ad')
        </div>
    </div>

    <div class="fixed-action-btn direction-top" style="right: 24px;">
        <a class="btn-floating btn-large red">
            <i class="material-icons">menu</i>
        </a>
        <ul>
            <li>
                <a class="btn-floating red" style="opacity: 0; transform: scale(0.4) translateY(40px) translateX(0px);">
                    <i class="material-icons">insert_chart</i>
                </a>
            </li>
            <li>
                <a class="btn-floating yellow darken-1" style="opacity: 0; transform: scale(0.4) translateY(40px) translateX(0px);">
                    <i class="material-icons">format_quote</i>
                </a>
            </li>
            <li>
                <a class="btn-floating green" style="opacity: 0; transform: scale(0.4) translateY(40px) translateX(0px);">
                    <i class="material-icons">publish</i>
                </a>
            </li>
            <li>
                <a class="btn-floating blue" style="opacity: 0; transform: scale(0.4) translateY(40px) translateX(0px);">
                    <i class="material-icons">attach_file</i>
                </a>
            </li>
        </ul>
    </div>
@endsection
