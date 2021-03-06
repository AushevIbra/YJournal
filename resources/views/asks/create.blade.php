@extends('layouts.layout')
@section('title', 'Задать вопрос')
<?php $hide = true; ?>
@section('content')

    <form class="col s12" method="POST" action="{{route('asks.store')}}">
        @csrf
        <div class="card" style="padding: 15px;">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="red-text">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="input-field col s12">
                    <input placeholder="Укажите тему Вашего вопроса *" value="{{old('title')}}"  name="title"  type="text" class="validate">
                    <span class="helper-text" data-error="wrong" data-success="right"></span>

                    <label for="first_name">Тема вопроса</label>
                </div>

                <div class="input-field col s12">
                    <textarea id="textarea1" placeholder="Опишите свою проблему *" class="materialize-textarea"
                              name="body">{{old('body')}}</textarea>
                    <label for="textarea1">Описание</label>
                </div>
            </div>

        </div>
        <button class="btn blue">Задать</button>
    </form>
@endsection
