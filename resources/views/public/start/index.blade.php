@extends('public.start.layout')

@section('pageContent')
    @include('public.start.elements.premiersSlider')
    @include('public.elements.filter')
    @include('public.start.elements.movieShow')

    <div class="page-about i-iblock">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 my-3">
                    <h3 class="card-title">О сети кинотеатров &laquo;Го в Кинчик&raquo;</h3>
                    <p>Laravel is a web application framework with expressive, elegant syntax. We’ve already laid the foundation — freeing you to create without sweating the small things.</p>
                    <h5>Laravel Forge</h5>
                    <p>Instant PHP Platforms on DigitalOcean, Linode, and more. Featuring push-to-deploy, Redis, queues, and everything else you could need to launch and deploy impressive Laravel applications.</p>
                    <a class="btn btn-primary shadow" href="{{ route('public.about') }}" role="button">Подробнее</a>
                    <a class="btn btn-primary shadow" href="{{ route('public.cinemas.index') }}" role="button">Кинотеатры</a>
                </div>
                <div class="col-sm-6 my-3">
                    @include('public.elements.cinemaMap')
                </div>
            </div>
        </div>
    </div>
@endsection
