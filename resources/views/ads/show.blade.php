@extends('layouts.ad')

@section('title', $ad->title)
@section('description', clearText($ad->content))
@section("main_img", "https://$_SERVER[HTTP_HOST]". getMainImage($ad->imgs))

@section('ad')
    <div class="card-panel light lighten-5 z-depth-1">
        <div class="item clearfix">
            <div class="item-top clearfix">
                <div class="breadcrumbs">
                    <ul>
                        <li>
                            <a href="{{route('board')}}">Объявления</a>
                        </li>
                        <li>
                            <a href="{{route('board', ['catId' => $parentCategory->id])}}">{{$parentCategory->name}}</a>
                        </li>

                        <li>
                            <a href="{{route('board', ['catId' => $ad->category->id])}}">{{$ad->category->name}}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <h1>{{$ad->title}}</h1>
            <div class="y-slider">
                @if($ad->imgs == null)
                    <div class="carousel">
                        <a class="carousel-item"><img src="https://hoam.ru/img/placeholder.jpg" alt="Изображения нет"/></a>
                    </div>
                @else
                    <div class="carousel">
                        @foreach(getImages($ad->imgs) as $img)
                            <a class="carousel-item"><img src="{{$img}}"></a>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="item-desc">
                <div class="item-pt clearfix">
                    <div class="item-price">100 руб.</div>
                    <div class="time-view">
                        <p>
                            {{$ad->created_at->diffForHumans()}}
                        </p>
                        <span>{{$ad->views}}</span>
                    </div>
                </div>
                <div class="item-specific">
                    <h4>Описание</h4>
                    <p>{{$ad->content}}</p>
                    <h4 class="item-contacts">Контакты</h4>
                    <dl class="clearfix">
                        <dt>Местоположение</dt>
                        <dd>{{$ad->address}}</dd>
                        <dt>Продавец</dt>
                        <dd>{{$ad->name}}</dd>
                    </dl>
                    <div class="item-phone"><a href="tel:{{$ad->number}}">{{$ad->number}}</a></div>
                    <p class="say-about-us-text">Скажите, что нашли это объявление на YJournal.ru</p>
                </div>
            </div>
            <div class="item-comments">
                <div class="item-share clearfix">
                {{--<div class="item-share-group1">--}}
                {{--<button class="fav button-2 " data-set-url="https://hoam.ru/aadd/setfavorite/76587" data-remove-url="https://hoam.ru/aadd/removefavorite/76587" data-auth="">В избранное--}}
                {{--</button>--}}

                {{--</div>--}}

                <!-- share -->
                    <script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
                    <script src="//yastatic.net/share2/share.js"></script>
                    <div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,whatsapp,telegram"></div>
                    <!-- /share -->

                    {{--<div class="social"></div>--}}
                    {{--<p class="ad-add2fav-warning">Чтобы добавить в избранное, необходимо <a id="open-popup" href="">авторизоваться</a>.</p>--}}
                </div>
                <h4 class="comments-title">Вопросы владельцу</h4>
                Это объявление от неавторизованного пользователя. Автор не может получать вопросы.
                (В разработке)
            </div>
            @if($related->count() > 0)
                <div class="item-related">
                    <h4>Похожие объявления</h4>
                    <ul>
                        @foreach($related as $item)
                            <li class="clearfix">
                                <a href="{{route('ads.show', $item->id)}}">
                                    <img src="{{getMainImage($item->imgs)}}" class="responsive-img" alt="{{$item->title}}">
                                </a>
                                <div class="related-wraper">
                                    <div class="related-title">
                                        <a href="{{route('ads.show', $item->id)}}">{{clearText($item->title, 100)}}</a>
                                    </div>
                                    <div class="related-desc">
                                        {{clearText($item->content, 50)}}
                                    </div>
                                    <div class="related-price">{{$item->price}} руб.</div>
                                </div>
                            </li>
                        @endforeach

                    </ul>
                </div>
            @endif
        </div>
    </div>
    <div class="full-img center">
        {{--<img src="https://lorempixel.com/250/250/nature/1">--}}
    </div>

@endsection
@section('js')
    <script>
        $('.carousel').carousel();
        const container = $(".full-img");
        $(document).on('click', '.carousel-item.active > img', function (e) {
            container.find('img').remove();
            $('.full-img').append(`<img src="${e.target.src}" />`);
            container.addClass('active');

        })
        $('.full-img').on('click', function () {
            container.removeClass('active')
        })
    </script>
@endsection
