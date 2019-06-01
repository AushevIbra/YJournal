@extends('layouts.layout')
<?php $hide = true; ?>
@section('title', 'Написать')
@section('content')
    <style>
        body {
            background: #fff;
        }
    </style>
    <link rel="stylesheet" href="{{asset('css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/stylesheet.css')}}">
    <link rel="stylesheet" href="{{asset('css/selectize.default.css')}}">
    <link rel="stylesheet" href="{{asset('css/normalize.css')}}">
    <div class="row">

        <div class="col m9 offset-m1 s12">
            <div>
                {{--<div class="hide-on-large-only">--}}
                {{--<a href="javascript:void(0)" class="myButton post-create">Опубликовать <i class="material-icons tiny">edit</i></a>--}}

                {{--</div>--}}
            </div>
            <div style="display: flex; justify-content: space-between" class="hide-on-med-and-down">
                <div style="display: flex; align-items: center;">
                    <div style="background: url('{{Auth::user()->avatar}}'); height: 25px; width: 25px; background-size: contain; border-radius: 50%;">

                    </div>
                    <a href="{{route('user.profile', ['id' => Auth::user()->id])}}">&nbsp;{{Auth::user()->name}}</a>
                </div>
                <div class="">
                    <a href="javascript:void(0)" data-id="create-post" class="myButton post-create">
                        Опубликовать <i class="material-icons tiny">edit</i>
                    </a>

                </div>
            </div>
            <div class="create-form">
                <!--<textarea name="title" id="create-form__title" cols="30" rows="10" placeholder="Заголовок"></textarea> -->
                <div id="codex-editor"></div>

            </div>
            <div class="input-field col s12">
                <div>
                    <select id="select-state" name="tags[]" multiple class="demo-default" style="width:100%" placeholder="Тэги...">
                        @foreach($tags as $tag)
                            <option value="{{$tag->title}}">{{$tag->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="hide-on-large-only fixed-action-btn">
        <a href="javascript:void(0)" data-id="create-post" class="btn-floating btn-large blue">
            <i class="large material-icons">mode_edit</i>
        </a>
    </div>

@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/codex.editor@2.0.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/codex.editor.header@2.0.4/dist/bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/codex.editor.image@1.0.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/codex.editor.paragraph@2.0.2"></script>
    <script src="https://cdn.jsdelivr.net/npm/codex.editor.list@1.0.2"></script>
    <script src="https://cdn.jsdelivr.net/npm/codex.editor.quote@2.0.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/codex.editor.checklist@1.0.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/codex.editor.marker@1.0.1"></script>
    <script src="https://cdn.jsdelivr.net/npm/codex.editor.delimiter@1.0.1"></script>
    <script src="{{asset('editor/embed.js')}}"></script>
    <script src="{{ asset('assets/js/init.js') }}"></script>
    <script src="{{asset('js/selectize.js')}}"></script>
    <script src="{{asset('js/selectize_index.js')}}"></script>

    <script>
        //$('.select-tag').select2({width: "100%"});
        $(document).ready(function () {
            $('.fixed-action-btn').floatingActionButton();
        });
        $('#select-state').selectize({
            //maxItems: 3,
            create: true,
        });
    </script>
@endsection
