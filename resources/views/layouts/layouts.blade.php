<!DOCTYPE html>
<html>
@include('layouts.head')
<body class="@yield('body-class')">
    @include('layouts.header')
    <div class="page-content">
        @include('layouts.sidebar')
        @yield('content')
    </div>
    @include('layouts.footer')
</body>
</html>
