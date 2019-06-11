@extends('layouts.ad')
@section('title', 'Добавить объявление')
@section('ad')
    <div class="card">
        <div class="card-body">
            <form class="col s12 addForm" method="POST" action="{{route('ads.store')}}">
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
                        <div class="input-field col s12 m6">
                            <input placeholder="Укажите номер телефона" value="{{old('number')}}" name="number" type="text">
                            <label for="phone">Телефон <span class="red-text">*</span></label>
                        </div>

                        <div class="input-field col s12 m6">
                            <input placeholder="Введите своё имя" value="{{old('name')}}" name="name" type="text">
                            <label for="name">Контактное имя <span class="red-text">*</span></label>
                        </div>

                        <div class="input-field col s12">
                            <select class="black-text" name="category_id">
                                @foreach($categories as $cat)
                                    @if(count($cat->children) > 0)
                                        <optgroup label="{{$cat->name}}">
                                            @foreach($cat->children as $child)
                                                <option value="{{$child->id}}">{{$child->name}}</option>
                                            @endforeach
                                        </optgroup>
                                    @else
                                        <optgroup label="{{$cat->name}}">
                                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                                        </optgroup>
                                    @endif
                                @endforeach
                            </select>
                            <label>Выберите категорию <span class="red-text">*</span></label>
                        </div>

                        <div class="input-field col s12">
                            <input placeholder="Заголовок" value="{{old('title')}}" name="title" type="text">
                            <label for="title">Заголовок <span class="red-text">*</span></label>
                        </div>

                        <div class="input-field col s12">
                             <textarea id="textarea1" placeholder="Текст объявления" class="materialize-textarea"
                                       name="content">{{old('content')}}</textarea>
                            <label for="textarea1">Описание <span class="red-text">*</span></label>
                        </div>

                        <div class="input-field col s12">
                            <input type="text" name="address" placeholder="Укажите адрес" value="{{old('address')}}">
                            <label for="price">Адрес <span class="red-text">*</span></label>

                        </div>

                        <div class="input-field col s6">
                            <input type="text" name="price" placeholder="Укажите цену" value="{{old('price')}}">
                            <label for="price">Цена <span class="red-text">*</span></label>

                        </div>

                        <div class="input-field col s6">
                            <label>
                                <input type="checkbox"/>
                                <span>Бесплатно</span>
                            </label>

                        </div>

                        <div class="input-field col s12">
                            <div class="dropzone"></div>

                        </div>


                    </div>

                </div>
                <button class="btn blue">Создать</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $(document).ready(function () {
                $('select').formSelect();
                $(".dropzone").dropzone({
                    url: "/api/upload-image",
                    paramName: 'image',
                    maxFiles: 5,
                    success: (data, response) => {
                        console.log(response)
                        const elem = document.createElement('input');
                        elem.setAttribute('name', 'imgs[]');
                        elem.setAttribute('value', response.file.url);
                        elem.setAttribute('type', 'hidden');
                        $(".addForm").append(elem);
                    }
                });
            });
        })
    </script>
@endsection
