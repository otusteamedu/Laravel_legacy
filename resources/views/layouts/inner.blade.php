@include('blocks.header')

    @include('blocks.h1.jumbotron')

    <div class="container">
        @yield('content')
    </div>

@include('blocks.footer')