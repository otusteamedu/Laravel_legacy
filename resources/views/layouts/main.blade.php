<!doctype html>
<html class="tm-main tm-teal-bg">

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
