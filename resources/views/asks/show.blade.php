@extends('layouts.layout')
<?php $route = "asks.create"; ?>

@section('title', $ask->title)
@section('content')

    <div class="card-panel light lighten-5 z-depth-1" style="box-shadow: none;">
        <div class="inline-flex">
            <div><img src="{{$ask->user->avatar}}" alt="" class="circle m-5px" height="36"></div>
            <div>
                <h1 href="#" class="black-text" style="font-weight: bold; font-size: 20px; margin: 0px;">{{$ask->title}}</h1>
                <div>
                    {{$ask->body}}
                </div>
                <div class="d-flex" style="font-size: 0.8rem; color: rgba(167, 167, 167, 0.87);">
                    <p><strong>Добавлено:</strong> {{$ask->created_at}}</p>
                    <p style="margin-left: 3px;"><strong>Просмотров:</strong> {{$ask->views}}</p>
                    <p style="margin-left: 3px;"><strong>Рейтинг:</strong> {{$ask->rating}}</p>
                    <p style="margin-left: 3px;"><strong>Ответов:</strong> {{$ask->countAnswers->count()}}</p>
                    <p style="margin-left: 3px;"><strong>Пользователь:</strong> {{$ask->user->name}}</p>
                </div>
            </div>
        </div>
    </div>

    <div id="react-comments" data-id="{{$ask->id}}"></div>

    @section('js')
        <script src="{{asset("js/answers.js?time=".time())}}"></script>
    @endsection
@endsection
