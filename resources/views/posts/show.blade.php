@extends('layouts.layout')
@section('title', $data->title)

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
                            <div class="post-views">336</div>
                        </div>
                    </div>
                </div>
                <h1>{{$data->title}}</h1>

                <div class="post-extra">
                    <a href="#comments" class="post-comments grl">18 комментариев</a>
                    <div class="share">
                        <script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
                        <script src="//yastatic.net/share2/share.js"></script>
                        <div class="ya-share2" data-services="vkontakte,facebook,twitter,whatsapp,telegram"></div>
                    </div>
                </div>
                <?php  $codex->render(); ?>
            </div>

            <div id="react-comments" data-post-id="{{$data->id}}"></div>


        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('js/comments.js')}}"></script>
@endsection
