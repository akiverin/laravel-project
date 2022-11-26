@extends('layouts.layout')
@section('content')
<div class="gallery__wrapper">
    <img class="gallery__image" src="{{URL::asset($full)}}" alt="">
</div>
    <style>
        .gallery__image {
            width: 100%;
            height: calc(100vh - 72px);
            object-fit: cover
        }
    </style>
@endsection