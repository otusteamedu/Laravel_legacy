<!DOCTYPE html>
<html lang="en">
<head>
    @include('public.head.head')
</head>
<body>
    @include('public.head.nav')
    @include('public.head.catalogMenu')
    @yield('contentWrap')
    @include('public.footer.footer')
</body>
</html>