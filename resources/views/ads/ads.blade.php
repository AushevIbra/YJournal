@extends('layouts.ad')


@section('ad')
    <div class="card-panel light lighten-5 z-depth-1">
        <div class="flex ad-header">
            <div class="">
                <h1 class="card-header" style="font-size: 14px; line-height: unset; margin: unset;">Доска объявлений в Ялте</h1>
                <span>Самые свежие объявления в Ялте</span>
            </div>
            <a href="{{route('ads.create')}}" class="btn site-color">Добавить</a>
        </div>
        <div class="card-body">
            @foreach($ads as $ad)
                <div class="list-item clearfix desrap" style="position: relative;">
                    <a href="{{route('ads.show', $ad->id)}}" class="ad-image-link">
                        <img src="{{$ad->getMainImage($ad->imgs)}}" alt="">
                    </a>
                    <div class="list-text">
                        <div class="list-item-title">
                            <a href="{{route('ads.show', $ad->id)}}">{{$ad->title}}</a>
                            <div class="list-item-price ">
                                <span>{{$ad->price}} руб.</span>
                            </div>
                        </div>
                        <p class="list-desc">{{$ad->content}}.</p>
                    </div>
                    <div class="meta clearfix">
                        <a href="" title="Добавить в избранное" class="meta-fav " data-set-url="https://hoam.ru/aadd/setfavorite/76578" data-remove-url="https://hoam.ru/aadd/removefavorite/76578"
                           data-favorite-url="https://hoam.ru/profile/favorite"></a>
                        <a href="https://hoam.ru/category/construction_materials" class="meta-cat">{{$ad->category->name}}</a>
                        <a href="https://hoam.ru?city=14" class="meta-city">{{$ad->address}}</a>
                        <span class="meta-time">
                            {{$ad->created_at->diffForHumans()}}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
