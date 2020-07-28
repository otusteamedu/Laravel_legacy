@extends('layouts.app')

@section('top_nav')
    @include('navigation.top_menu')
@endsection

@section('main')
<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <h2>Contacts</h2>

            <ul>
                <li><a href="#">VK</a></li>
                <li><a href="#">Facebook</a></li>
                <li><a href="#">Twitter</a></li>
                <li><a href="#">Instagram</a></li>
                <li><a href="#">WhatsApp</a></li>
                <li><a href="#">Viner</a></li>
                <li><a href="#">Telegram</a></li>
            </ul>

            <div class="map">
                <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3Abe2b9f15df6811b62d676ce4650bd878ed142a555f3c6d709e047b94ccee006d&amp;source=constructor" width="100%" height="400" frameborder="0"></iframe>
            </div>

        </div>
        @include('layouts.sidebar')
    </div>
</div>
@endsection

@section('footer')
@include('layouts.footer')
@endsection


