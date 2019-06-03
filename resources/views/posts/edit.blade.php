@extends('layouts.layout')
<?php $hide = true; ?>
@section('title', 'Редактировать - ' . $post->title)
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
                    <a href="javascript:void(0)" data-id="update-post" class="myButton post-update">
                        Изменить <i class="material-icons tiny">edit</i>
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
        <a href="javascript:void(0)" data-id="update-post" class="btn-floating btn-large blue">
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
    <script src="{{asset('js/selectize.js')}}"></script>
    <script src="{{asset('js/selectize_index.js')}}"></script>
    <script>
        var editor = new CodexEditor({
            /**
             * Create a holder for the Editor and pass its ID
             */
            holderId: 'codex-editor',

            /**
             * Available Tools list.
             * Pass Tool's class or Settings object for each Tool you want to use
             */
            tools: {
                header: {
                    class: Header,
                    inlineToolbar: true,
                    config: {
                        placeholder: 'Введите заголовок'
                    }
                },
                checklist: {
                    class: Checklist,
                    inlineToolbar: true,
                },
                Marker: {
                    class: Marker,
                    shortcut: 'SHIFT+M',
                },
                paragraph: {
                    class: Paragraph,
                    inlineToolbar: true,

                },
                list: {
                    class: List,
                    inlineToolbar: true,
                },
                delimiter: Delimiter,
                quote: Quote,
                image: {
                    class: ImageTool,
                    config: {
                        url: '/api/upload-image',
                    },


                }
            },

            /**
             * Previously saved data that should be rendered
             */
            data: {
                {!! $renderBlocks !!}

            },

        });


        $('[data-id="update-post"]').on('click', function () {
            const tags = $('#select-state').val();
            editor.saver.save().then((savedData) => {
                if (savedData.blocks[0].type !== 'header' || savedData.blocks[0].data.text === '') {
                    M.toast({html: 'Заполните заголовок', classes: 'rounded'});
                } else {
                    if (savedData.blocks.length == 1) {
                        M.toast({html: 'Ваша запись слишком короткая', classes: 'rounded'});
                        throw "Ваша запись слишком короткая";
                    }
                    let img = null;
                    savedData.blocks.map(item => {
                        if(item.type == 'image') {
                            img = item.data.file.url;
                        }
                    })
                    let elem_title = document.createElement(`h${savedData.blocks[0].data.level}`);
                    elem_title.innerHTML = savedData.blocks[0].data.text;
                    let title = elem_title.textContent;

                    var data = {data: savedData, title, tags, img};
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "PUT",
                        url: '/post/{{$post->id}}',
                        data: {data},
                        success: (data) => {
                            location.href = `/post/${data.slug}`;
                        },
                        //dataType: dataType
                    });
                }


            });
        })
    </script>
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
