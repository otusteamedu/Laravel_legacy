@include('admin.blocks.header')

    @include('admin.blocks.h1.jumbotron')

    <div class="container">
        @yield('content')
    </div>

@include('admin.blocks.footer')