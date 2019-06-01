@extends('layouts.layout')
@section('title', 'Пользователь')
@section('content')
    <div class="row">
        <div class="col m4 s12">
            <div class="card">
                <div class="card__user-info center">
                    <div class="card__user-info__img"></div>
                    {{$tag}} <br>
                </div>
            </div>
        </div>
        <div class="col m8 s12">
            <div id="react-user-post" data-nav="null" data-tag="{{$tag}}"></div>
        </div>
    </div>
@endsection
