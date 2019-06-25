<?php $hide = true; ?>
@extends('layouts.layout')
@section('title', 'YJournal - работа в Ялте')
@section('css')
@endsection
@section('content')

    <div id="react-job"></div>

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
            <li>
                <a class="btn-floating sidenav-trigger yellow" data-target="nav-mobile1" style="opacity: 0; transform: scale(0.4) translateY(40px) translateX(0px);">
                    <i class="material-icons">arrow_forward</i>
                </a>
            </li>
        </ul>
    </div>
@endsection

@section('js')
    <script src="{{asset('js/job.js?v='.time())}}"></script>
@endsection
