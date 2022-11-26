@extends('layouts.layout')
@section('content')
    <section class="home">
        <marquee width="100%" direction="left">
            @foreach($sliderArticles as $article)
                <span>{{$article['name']}} <a href="/news/show/{{$article['id']}}">Подробнее</a> </span>
            @endforeach
        </marquee>
      <div class="home__wrapper">
        <h1 class="home__title">Добро пожаловать!</h1>
        <h2 class="home__subtitle">Читайте самые актуальные новости на нашем сайте.</h2>
        <a href="/news" class="home__link"><span>Перейти к статьям</span></a>
        <div class="slider">
            <div class="slider__wrapper">
                <ul v-bind:style="styleList" class="slider__list">
                    {{-- <li class="slider__item">
                        <a :to="{ path: 'articles/'+article.id , params: { articleId: article.id }}" class="slider__link">
                            <div class="slider__info">
                                <p class="slider__date">{{article.date}}</p>
                                <h2 class="slider__title">{{article.name}}</h2>
                                <p class="slider__description">{{article.shortDesc}}</p>
                            </div>
                            <img :src="article.preview_image" alt="Slider Item Cover" class="slider__image">
                        </a>
                    </li> --}}
                </ul>
            </div>
            {{-- <div class="slider__action">
                <button class="slider__button" id="sliderButtonLeft" @click="sliderStapLeft" :disabled="this.buttonLeftDisabled">
                    <svg class="slider__icon slider__icon" id="arrowLeft" :class="{toggled: isToggled}" version="1.1" viewBox="0 0 16 16" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M8,0C3.582,0,0,3.582,0,8s3.582,8,8,8s8-3.582,8-8S12.418,0,8,0z M10.354,12.646l-0.707,0.707L4.293,8l5.354-5.354  l0.707,0.707L5.707,8L10.354,12.646z"/></svg>
                </button>
                <button class="slider__button" id="sliderButtonRight" @click="sliderStapRight" :disabled="this.buttonRightDisabled">
                    <svg class="slider__icon slider__icon" id="arrowRight" version="1.1" viewBox="0 0 16 16" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M8,0C3.582,0,0,3.582,0,8s3.582,8,8,8s8-3.582,8-8S12.418,0,8,0z M6.354,13.354l-0.707-0.707L10.293,8L5.646,3.354  l0.707-0.707L11.707,8L6.354,13.354z"/></svg>
                </button>
            </div> --}}
        </div>
    </div>
    </section>
@endsection