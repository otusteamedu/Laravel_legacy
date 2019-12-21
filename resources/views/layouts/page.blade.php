<!doctype html>
<html class="tm-page @yield('page_class')">

@include('blocks.head')

<body>

<div id="app">
    @include('blocks.navbar')

    <main>
        @section('content')
        @show
    </main>

    @include('blocks.footer')
</div>

<script src="{{ mix('/js/app.js') }}"></script>
@stack('script')

</body>
</html>
