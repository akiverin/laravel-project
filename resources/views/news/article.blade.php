@extends('layouts.layout')
@section('content')
    <section class="article">
        <div class="article__wrapper">
            <h2 class="article__title">{{$article['name']}}</h2>
            <div class="article__info">
                <div class="article__text">
                    @php
                        echo htmlspecialchars_decode($article['desc']);
                    @endphp
                </div>
                <div class="article__dinamic">
                <img class="article__image" src="{{URL::asset($article['full_image'])}}" alt="">
                    <div class="summary">
                        <div class="summary-item">
                            <h5 class="item-title">Время прочтения</h5>
                            <p class="item-text"><span class="item-data">{{$article['time_read']}}</span> минут</p>
                        </div>
                        <div class="summary-item">
                            <h5 class="item-title">Просмотры</h5>
                            <p class="item-text"><span class="item-data">{{$article['views']}}</span> читатель</p>
                        </div>
                        <div class="summary-item">
                            <h5 class="item-title">Дата публикации</h5>
                            <p class="item-text"><span class="item-data" id="dateData">{{$article['date']}}</span></p>
                        </div>
                    </div>
                </div>
            </div>
            @can('create')
            <a href="/news/{{$article->id}}/edit" class="article__button article__edit">Редактировать</a>
            <a href="/news/{{$article->id}}/delete" class="article__button article__delete">Удалить</a>
            @endcan
            <div class="comments">
                <h3 class="comments__title">Комментарии</h3>
                <ul class="comments__list">
                    @foreach($comments as $comment)
                    <li class="comments__item">
                        <form action="/comment/{{$comment->id}}" method="post">
                            @csrf
                            @method('DELETE')
                            <div class="comments__author">
                                <img src="https://cdn-icons-png.flaticon.com/512/1077/1077012.png?w=1060&t=st=1663004331~exp=1663004931~hmac=2eea0c330fda559d2effd70b02efa45e0d457249f3e78aa2b7dd071ab54edd72" alt="User avatar" width="64px" height="64px" class="comments__avatar">
                                <h4 class="comments__author-name">{{$comment->title}}</h4>
                            </div>
                            <p class="comments__text">{{$comment->text}}</p>
                            @can('update-comment', $comment)
                            <div class="comments__actions">
                                <a href="/comment/{{$comment->id}}/edit" class="comments__edit">
                                    <svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><g clip-rule="evenodd" fill="currentColor" fill-rule="evenodd"><path d="M9.56 4.1h3.54a.9.9 0 1 1 0 1.8H9.6c-1 0-1.69 0-2.23.04-.52.05-.82.13-1.05.24a2.6 2.6 0 0 0-1.14 1.14c-.11.23-.2.53-.24 1.05-.04.54-.04 1.24-.04 2.23v3.8c0 1 0 1.69.04 2.23.05.52.13.82.24 1.05.25.49.65.89 1.14 1.14.23.11.53.2 1.05.24.54.04 1.24.04 2.23.04h3.8c1 0 1.69 0 2.23-.04.52-.05.82-.13 1.05-.24a2.6 2.6 0 0 0 1.14-1.14c.11-.23.2-.53.24-1.05.04-.54.04-1.24.04-2.23v-3.5a.9.9 0 0 1 1.8 0v3.54c0 .95 0 1.71-.05 2.33a4.5 4.5 0 0 1-.43 1.73 4.4 4.4 0 0 1-1.92 1.92 4.5 4.5 0 0 1-1.73.43c-.62.05-1.38.05-2.33.05H9.56c-.95 0-1.71 0-2.33-.05a4.5 4.5 0 0 1-1.73-.43 4.4 4.4 0 0 1-1.92-1.92 4.51 4.51 0 0 1-.43-1.73c-.05-.62-.05-1.38-.05-2.33v-3.88c0-.95 0-1.71.05-2.33.05-.64.16-1.2.43-1.73A4.4 4.4 0 0 1 5.5 4.58a4.51 4.51 0 0 1 1.73-.43c.62-.05 1.38-.05 2.33-.05z"></path><path d="M19.12 3.33a1.1 1.1 0 1 1 1.56 1.55l-.35.35a.4.4 0 0 1-.57 0l-.99-.99a.4.4 0 0 1 0-.56zm-.6 2.57-.42-.42c-.44-.44-.72-.42-1.13 0l-5.13 5.12c-1.95 1.96-3.19 3.89-2.76 4.32.43.43 2.36-.8 4.32-2.76l5.12-5.13c.44-.44.42-.72 0-1.13z"></path></g></svg>                                    
                                    <span class="visually-hidden">Редактирование</span>
                                </a>
                                <button type="submit" class="comments__delete">
                                    <svg width="28" height="28" viewBox="0 0 28 28" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M22 10V20.5C22 22.9853 19.9853 25 17.5 25H10.5C8.01472 25 6 22.9853 6 20.5V10H5.29019C4.57764 10 4 9.42236 4 8.70981V7.25C4 5.73122 5.23122 4.5 6.75 4.5H8.40116C8.92486 3.59342 9.90309 3 11 3H17C18.0969 3 19.0751 3.59342 19.5988 4.5H21.25C22.7688 4.5 24 5.73122 24 7.25V8.70981C24 9.42236 23.4224 10 22.7098 10H22ZM21 8H22V7.25C22 6.83579 21.6642 6.5 21.25 6.5H18.937C18.4807 6.5 18.0823 6.19114 17.9686 5.74926C17.856 5.3121 17.4589 5 17 5H11C10.5411 5 10.144 5.3121 10.0314 5.74926C9.91771 6.19114 9.51929 6.5 9.06301 6.5H6.75C6.33579 6.5 6 6.83579 6 7.25V8H7H21ZM8 10V20.5C8 21.8807 9.11929 23 10.5 23H17.5C18.8807 23 20 21.8807 20 20.5V10H8Z" fill="#E64646"/>
                                    </svg>
                                    <span class="visually-hidden">Удалить</span>
                                </button>
                            </div>    
                            @endcan
                        </form>
                    </li>
                    @endforeach
                </ul>
                @if($errors->any())
                    <div class="alert-danger">
                        <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif
                <form class="comments__form" action="/comment" method="post">
                    @csrf
                    <div class="comments__field">
                        <label class="comments__label" for="title">Заголовок</label>
                        <input class="comments__input" type="text" name="title" id="title" placeholder="Введите заголовок вашей рецензии" required>
                    </div>
                    <div class="comments__field">
                        <label class="comments__label" for="text">Комментарий</label>
                        <textarea class="comments__textarea" required placeholder="Ваши мысли о прочитанном..." name="text" id="text"></textarea>
                    </div>
                    <input type="hidden" name="id" value="{{$article->id}}">
                    <button class="comments__button" type="submit">Опубликовать</button>
                </form>
            </div>
        </div>
    </section>
@endsection
