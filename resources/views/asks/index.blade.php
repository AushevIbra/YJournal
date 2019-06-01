<?php $route = "asks.create"; ?>
@extends('layouts.layout')
@section('title', 'Ялтинское независимое медиапространство')

@section('content')
    <div class="row">
        <div class="col m8 s12">
            <div id="react-answer"></div>
        </div>

        <div class="col m4 hide-on-med-and-down">
            <div class="questions__sidebar-block">
                <div class="section-title"><span>Последние обсуждения</span></div>
                <ul class="popular-questions">
                    @foreach($answers as $answer)
                        <li style="border-bottom: 1px solid #eaeaea; line-height: 30px; color:#737373;">
                            <a href="{{route('asks.show', $answer->ask_id)}}">{{strlen($answer->text) > 50 ? mb_substr($answer->text, 0 ,40) . "..." : $answer->text}}</a><br>
                            <small><b>Пользователь:</b> <span>{{$answer->user->name}} <b>Обсуждение: </b><a href="{{route('asks.show', $answer->ask_id)}}">{{mb_substr($answer->ask->title, 0,5)}}... </a></span></small>
                        </li>

                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('js/ask.js')}}"></script>
@endsection

