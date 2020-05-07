@extends('emails.layouts.mail')

@section("content")
Вы успешно создали событие с типом: {{ $event->getTypeName() }}
по адресу {{ $event->getCountryName()}} {{ $event->region}}
с координатами {{ $event->lat }} {{ $event->long }}
@stop
