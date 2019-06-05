<?php $html = $codex->render(); $description = mb_substr(strip_tags($html), 0, 150);  ?>
@extends('layouts.layout')
@section('title', $data->title)
@section('description', strlen($description) < 150 ? $description : $description . "...")
@section("main_img", "https://$_SERVER[HTTP_HOST]".$data->main_img)
@section('css')
    <link rel="stylesheet" href="{{asset("css/zoom.css")}}">
@endsection

@section('content')

    <style>
        h2 {
            font-size: 1.56rem !important;
        }
    </style>
    <div class="row">
        <div class="col m9 offset-m1 s12">
            <div class="full-post">
                <div class="post-meta clearfix">
                    <div>
                        <a href="/user/2" class="post-meta-profile">
                            <span class="post-meta-avatar" style="background-image: url('{{$data->user->avatar}}')"></span>
                            <span class="post-meta-name">{{$data->user->name}}</span>
                        </a>
                        <div class="post-meta-date">{{$data->created_at->diffForHumans()}}</div>
                        <div class="post-stat">
                            <div class="post-views">{{$data->views}}</div>
                        </div>
                    </div>
                </div>
                <h1>{{$data->title}}</h1>
                <div class="post-extra">
                    <a href="#comments" class="post-comments grl">{{$data->count_comments_count}}</a>
                    <div class="share">
                        <script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
                        <script src="//yastatic.net/share2/share.js"></script>
                        <div class="ya-share2" data-services="vkontakte,facebook,twitter,whatsapp,telegram"></div>
                    </div>
                </div>
                {!! $html !!}
            </div>

            <div id="react-comments" data-post-id="{{$data->id}}"></div>


        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('js/comments.js')}}"></script>
    <script src="{{asset("js/zoom.js")}}"></script>
@endsection
