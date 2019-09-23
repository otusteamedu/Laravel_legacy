@extends('layouts.app')

@section('top_nav')
    @include('navigation.top_menu')
@endsection

@section('slider')
    @include('slider.slider')
@endsection

@section('main')
<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <div class="row post">
                <div class="col-sm-4 col-6">
                    <img width="100%" src="{{ asset('images/img-1.jpg') }}">
                </div>
                <div class="col-sm-8 col-6">
                    <span class="badge badge-warning category"><a href="#">Space</a></span>
                    <h2 class="post-title"> <a href="#">Title - 1</a></h2>
                    <div class="row post-meta">
                        <div class="col-6 post-autor">by Romchik</div>
                        <div class="col-6 post-date">03.09.2019</div>
                    </div>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard…</p>
                    <div class="row tags-wrap">
                        <ul class="tags">
                            <li>
                                <span class="badge badge-info tags-text"><a href="#">Space</a></span>
                            </li>
                            <li>
                                <span class="badge badge-info tags-text"><a href="#">Universe</a></span>
                            </li>
                            <li>
                                <span class="badge badge-info tags-text"><a href="#">Infinity</a></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row post">
                <div class="col-sm-4 col-6">
                    <img width="100%" src="{{ asset('images/img-2.jpg') }}">
                </div>
                <div class="col-sm-8 col-6">
                    <span class="badge badge-warning category"><a href="#">Space</a></span>
                    <h2 class="post-title"> <a href="#">Title - 2</a></h2>
                    <div class="row post-meta">
                        <div class="col-6 post-autor">by Romchik</div>
                        <div class="col-6 post-date">03.09.2019</div>
                    </div>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard…</p>
                    <div class="row tags-wrap">
                        <ul class="tags">
                            <li>
                                <span class="badge badge-info tags-text"><a href="#">Space</a></span>
                            </li>
                            <li>
                                <span class="badge badge-info tags-text"><a href="#">Universe</a></span>
                            </li>
                            <li>
                                <span class="badge badge-info tags-text"><a href="#">Infinity</a></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row post">
                <div class="col-sm-4 col-6">
                    <img width="100%" src="{{ asset('images/img-3.jpg') }}">
                </div>
                <div class="col-sm-8 col-6">
                    <span class="badge badge-warning category"><a href="#">Space</a></span>
                    <h2 class="post-title"> <a href="#">Title - 3</a></h2>
                    <div class="row post-meta">
                        <div class="col-6 post-autor">by Romchik</div>
                        <div class="col-6 post-date">03.09.2019</div>
                    </div>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard…</p>
                    <div class="row tags-wrap">
                        <ul class="tags">
                            <li>
                                <span class="badge badge-info tags-text"><a href="#">Space</a></span>
                            </li>
                            <li>
                                <span class="badge badge-info tags-text"><a href="#">Universe</a></span>
                            </li>
                            <li>
                                <span class="badge badge-info tags-text"><a href="#">Infinity</a></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.sidebar')
    </div>
</div>
@endsection

@section('footer')
    @include('layouts.footer')
@endsection


