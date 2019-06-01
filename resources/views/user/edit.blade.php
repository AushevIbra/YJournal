@extends('layouts.layout')

@section('title', 'Пользователь')
@section('content')
    <div class="row">
        <div class="col m12 s12 m2">
            <form method="post" action="{{route('user.setting')}}" enctype="multipart/form-data">
                @csrf
                <div class="card" style="padding: 15px; box-shadow: none;">
                    <div class="row">

                        <div class="col m6 s12">
                            <div class="row">
                                <div class="input-field col s12">
                                    <input placeholder="Введите имя..." value="{{old('name', $user->name)}}" name="name" id="first_name" type="text" class="validate">
                                    <label for="first_name">Имя</label>
                                </div>
                            </div>
                            {{--<div class="row">--}}
                                {{--<div class="input-field col s12">--}}
                                    {{--<input placeholder="Введите E-mail..." value="{{old('email', $user->email)}}" name="email" id="first_name" type="email" class="validate">--}}
                                    {{--<label for="first_name">Почта</label>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        </div>

                        <div class="col m6 s12" style="display: flex; justify-content: center;">
                            <div class="center">
                                <div class="profile-edit-avatar">
                                    <img id="load-image" src="{{auth()->user()->avatar}}" alt="">
                                    <input style="position: absolute; height: 125%; width: 100%; cursor: pointer; top: -30px; z-index: 5" type="file" name="avatar" accept="image/*" id="upload-image">
                                </div>

                            </div>

                        </div>

                    </div>

                </div>
                <button class="btn blue right">Обновить</button>
            </form>

        </div>
    </div>
@endsection
