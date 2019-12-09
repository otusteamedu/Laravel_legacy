@extends('layouts.main')

@section('title', __('message.site.about.title'))

@section('content')
    <main>
        <div class="container">
            <div class="about-section paddingTB60 gray-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7 col-sm-6">
                            <div class="about-title clearfix">
                                <h1>{{ __('message.site.about.header') }}</h1>
                                <h3>{{ __('message.site.about.subheader') }}</h3>
                                <p class="about-paddingB">{{ __('message.site.about.text1') }}</p>
                                <p>{{ __('message.site.about.text2') }}</p>
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-6">
                            <div class="about-img">
                                <img src="#" alt="Place for image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection