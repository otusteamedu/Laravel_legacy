<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('blocks.head')
<body>

@include('blocks.nav')

  <div class="container">
    @yield('content')
  </div>

@include('blocks.footer')
@include('blocks.scripts')

  </body>
</html>
