@extends('layouts.layout')
@section('title', 'Пользователь')
@section('content')
    <div class="row">
        <div class="col m4 s12">
            <div class="card">
                <div class="card__user-info center">
                    <div class="card__user-info__img"><img src="{{$user->avatar}}" class="circle" width="104" height="104"></div>
                    {{$user->name}} <br>
                    <span style="font-size: 11px;">Зарегистрирован: {{$user->created_at}}</span>
                    @if(auth()->guest() === false && auth()->user()->id === $user->id)
                        <div class="card__info center">
                            <a href="{{route('user.setting')}}" class="waves-effect waves-light btn btn-small site-color"><i class="tiny material-icons left">settings</i>Настройки</a>

                            <a href="{{route('logout')}}" class="waves-effect waves-light btn btn-small site-color"><i class="tiny material-icons left">exit_to_app</i>Выйти </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col m8 s12">
            <div id="react-user-post" data-nav="null" data-user="{{$user->id}}"></div>
        </div>
    </div>
@endsection
