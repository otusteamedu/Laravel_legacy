@extends('emails.layouts.mail')

@section("content")
Поблизости с Вами было создано событие с типом: {{ $event->getTypeName() }}
по адресу {{ $event->getCountryName()}} {{ $event->region}}
с координатами {{ $event->lat }} {{ $event->long }}.

@isset($event->description)
Описание события: {{ $event->description }}.
@endisset

Вы можете перейти на страницу события на сайте по ссылке: <a href="{{config("app.url")}}/events/{{$event->id}}"></a>.
@stop
