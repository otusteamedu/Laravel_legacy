@extends('public.about.layout')

@section('pageTitle')
    О сети кинотеатров &laquo;Go в Кинчик&raquo;
@endsection

@section('pageHeader')
    О сети кинотеатров &laquo;Go в Кинчик&raquo;
@endsection

@section('pageContentMain')
    <p>Laravel is a web application framework with expressive, elegant syntax. We’ve already laid the foundation —
        freeing you to create without sweating the small things.</p>
    <h2>Laravel Forge</h2>
    <img src="/images/cinemas/krasniy.jpg" align="left" vspace="10" hspace="10" width="40%" height="auto" />
    <p>Instant PHP Platforms on DigitalOcean, Linode, and more. Featuring push-to-deploy,
        Redis, queues, and everything else you could need to launch and deploy impressive Laravel applications.</p>
    <p>Laravel is a web application framework with expressive, elegant syntax. We’ve already laid the foundation —
        freeing you to create without sweating the small things.</p>
    <p>Laravel is a web application framework with expressive, elegant syntax. We’ve already laid the foundation —
        freeing you to create without sweating the small things.</p>
    <p>Laravel is a web application framework with expressive, elegant syntax. We’ve already laid the foundation —
        freeing you to create without sweating the small things.</p>
    <h2>Laravel Forge</h2>
    <img src="/images/cinemas/lux.jpg" align="right" vspace="10" hspace="10" width="40%" height="auto" />
    <p>Instant PHP Platforms on DigitalOcean, Linode, and more. Featuring push-to-deploy,
        Redis, queues, and everything else you could need to launch and deploy impressive Laravel applications.</p>
    <p>Laravel is a web application framework with expressive, elegant syntax. We’ve already laid the foundation —
        freeing you to create without sweating the small things.</p>
    <p>Laravel is a web application framework with expressive, elegant syntax. We’ve already laid the foundation —
        freeing you to create without sweating the small things.</p>
    <p>Laravel is a web application framework with expressive, elegant syntax. We’ve already laid the foundation —
        freeing you to create without sweating the small things.</p>
@endsection

@section('pageContentRight')
    @include('public.elements.cinemaMap')
    <h5>Кинотеатры сети</h5>
    @include('public.elements.cinemaList')
@endsection
