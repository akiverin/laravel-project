@extends('layouts.layout')
@section('content')
<div class="contact__wrapper">
    <p class="contact__title">
        Имя: 
    </p>
    <p class="contact__text"> {{$contact['name']}} </p>
    <p class="contact__title">
        Адрес: 
    </p>
    <p class="contact__text"> {{$contact['adress']}}
    <p class="contact__title">
        Телефон: 
    </p>
    <a href="tel:{{$contact['phone']}}" class="contact__text"> {{$contact['phone']}}</a>
    
    <p class="contact__title">
        Email:
    </p>
    <a href="mailto:{{$contact['email']}}" class="contact__text"> {{$contact['email']}}</a>
    
</div>
@endsection