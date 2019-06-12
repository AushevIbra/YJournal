@extends('layouts.ad')

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
                            <a href="{{route('board', ['catId' => $ad->category->parent->id])}}">{{$ad->category->parent->name}}</a>
                        </li>

                        <li>
                            <a href="{{route('board', ['catId' => $ad->category->id])}}">{{$ad->category->name}}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <h1>Лечение хронического простатита. Помощь уролога Санкт-Петербург</h1>
            <div class="y-slider">
                @if($ad->imgs == null)
                    <div class="no-image">
                        <img src="https://hoam.ru/img/placeholder.jpg" alt="Изображения нет" data-action="zoom">
                    </div>
                @else
                    <div class="no-image">
                        <img src="https://lorempixel.com/250/250/nature/1" data-action="zoom" class="img-responsive">
                        <img src="https://lorempixel.com/250/250/nature/2">
                        <img src="https://lorempixel.com/250/250/nature/3">
                    </div>
                @endif
            </div>
            <div class="item-desc">
                <div class="item-pt clearfix">
                    <div class="item-price">100 руб.</div>
                    <div class="time-view">
                        <p>
                            47 минут назад
                        </p>
                        <span>2</span>
                    </div>
                </div>
                <div class="item-specific">
                    <h4>Описание</h4>
                    <p>Лечение хронического простатита советы уролога <br>
                        Подскажу, что забыли сделать и как получить полное лечение простатита и аденомы простаты именно в вашем случае. <br>
                        <br>
                        Аденома простаты (ДГПЖ) <br>
                        Общая урология <br>
                        Простатит <br>
                        Цистит <br>
                        Бесплодие <br>
                        ЗППП <br>
                        Повышение потенции <br>
                        Импотенция (причины) <br>
                        Онкология <br>
                        Народные средства <br>
                        Ошибки в лечении аденомы, простатита, рака <br>
                        Здоровье женщины <br>
                        Исправление ошибок в лечении <br>
                        <br>
                        Лечение простатита, цистита, аденомы, онкологии и др. урологических заболеваний Санкт-Петербург</p>
                    <h4 class="item-contacts">Контакты</h4>
                    <dl class="clearfix">
                        <dt>Город</dt>
                        <dd>Али-Юрт</dd>
                        <dt>Продавец</dt>
                        <dd>Витольд</dd>
                    </dl>
                    <div class="item-phone"
                         data-value="eyJpdiI6IkN2RDBPNHJiZHZvVlRaeEF0eFhXUmc9PSIsInZhbHVlIjoiOXNzM29pNUd1eTdmdlwvTzBySkdRMFNsMmNjSlZ6UkJkdG9nTXZCM3o5ZDA9IiwibWFjIjoiNmFiZGQ1N2JlZThjMTQwYjMyYjdiMzliNDlkMzdlZDYxMjg2NmFkNTk0YWI2OTVkYTEzOTRjYTA3N2QyMjQzNiJ9"
                         data-root="https://hoam.ru"><a href="tel:89013722233">89013722233</a></div>
                    <p class="say-about-us-text">Скажите, что нашли это объявление на Хоам.ру</p>
                </div>
            </div>
            <div class="item-comments">
                <div class="item-share clearfix">
                    <div class="item-share-group1">
                        <button class="fav button-2 " data-set-url="https://hoam.ru/aadd/setfavorite/76587" data-remove-url="https://hoam.ru/aadd/removefavorite/76587" data-auth="">В избранное
                        </button>

                    </div>

                    <!-- share -->
                    <div class="item-share-group2">
                        <a class="fb-share button-2" href="#"
                           onclick="window.open('//www.facebook.com/sharer/sharer.php?u=https://hoam.ru/ad/76587&amp;title=Лечение хронического простатита. Помощь уролога Санкт-Петербург','','Toolbar=1,Location=0,Directories=0,Status=0,Menubar=0,Scrollbars=0,Resizable=0,Width=550,Height=400'); return false;">Поделиться</a>
                        <a class="vk-share button-2" href="http://vk.com/share.php?url=https://hoam.ru/ad/76587"
                           onclick="window.open('http://vk.com/share.php?url=https://hoam.ru/ad/76587','','Toolbar=1,Location=0,Directories=0,Status=0,Menubar=0,Scrollbars=0,Resizable=0,Width=550,Height=400'); return false;">Поделиться</a>
                    </div>
                    <!-- /share -->

                    <div class="social"></div>
                    <p class="ad-add2fav-warning">Чтобы добавить в избранное, необходимо <a id="open-popup" href="">авторизоваться</a>.</p>
                </div>
                <h4 class="comments-title">Вопросы владельцу</h4>
                Это объявление от неавторизованного пользователя. Автор не может получать вопросы.
            </div>
            <div class="item-related" style="clear: both;">
                <h4>Похожие объявления</h4>
                <ul>
                    <li class="clearfix">
                        <a href="https://hoam.ru/ad/75761">
                            <img src="https://hoam.ru/upload/2019/02/10/small_5c5feb716cb91.jpg" alt="">
                        </a>
                        <div class="related-wraper">
                            <div class="related-title">
                                <a href="https://hoam.ru/ad/75761">Электромассажер для лица и тело продаю. Торг уместен </a>
                            </div>
                            <div class="related-desc">Прибор для здоровья и красоты
                                Тел +7928 697 51 66
                            </div>
                            <div class="related-price">33 000 руб.</div>
                        </div>
                    </li>
                    <li class="clearfix">
                        <a href="https://hoam.ru/ad/76582">
                            <img src="https://hoam.ru/img/placeholder-small.jpg" alt="">
                        </a>
                        <div class="related-wraper">
                            <div class="related-title">
                                <a href="https://hoam.ru/ad/76582">Тур по Камчатке - К вулканам и гейзерам 60200 руб.</a>
                            </div>
                            <div class="related-desc">К вулканам и гейзерам - Комбинированный тур по Камчатке (активный, эко...</div>
                            <div class="related-price">60 200 руб.</div>
                        </div>
                    </li>
                    <li class="clearfix">
                        <a href="https://hoam.ru/ad/76583">
                            <img src="https://hoam.ru/img/placeholder-small.jpg" alt="">
                        </a>
                        <div class="related-wraper">
                            <div class="related-title">
                                <a href="https://hoam.ru/ad/76583">Защита прав военнослужащих, Военный юрист Санкт-Петербург</a>
                            </div>
                            <div class="related-desc">Защита прав военнослужащих, служащих, работников и сотрудников всех си...</div>
                            <div class="related-price">1 500 руб.</div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('js/zoom.js')}}"></script>
@endsection
