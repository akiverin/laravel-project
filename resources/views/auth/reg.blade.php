@extends('layouts.layout')
@section('content')
<div class="authorization">
    <div class="authorization__wrapper">
        <p class="authorization__title">Регистрация</p>
        @if($errors->any())
            <div class="authorization__alert alert">
                <ul class="alert__list">
                    @foreach($errors->all() as $error)
                        <li class="alert__item">
                          <p class="alert__error"> {{$error}} </p>
                        </li>
                    @endforeach 
                </ul>
            </div>
        @endif
        <form class="authorization__form" action="/auth/reg" method="post">
            @csrf
          <div class="authorization__block">
            <label for="exampleInputName" class="authorization__label">Имя</label>
            <input type="text" class="authorization__input" name="name">
          </div>
          <div class="authorization__block">
            <label for="exampleInputEmail1" class="authorization__label">Email</label>
            <input type="email" class="authorization__input" name="email" aria-describedby="emailHelp">
          </div>
          <div class="authorization__block">
            <label for="exampleInputPassword1" class="authorization__label">Пароль</label>
            <input type="password" class="authorization__input" name="password">
          </div>
          <button type="submit" class="authorization__button">Зарегистрироваться</button>
        </form>
    </div>
</div>
@endsection