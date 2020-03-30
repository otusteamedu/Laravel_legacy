@include('partials.app.header')

<body>

<div class="container-scroller">
<!-- partial -->
    <div class="container-fluid page-body-wrapper full-page-wrapper">

       @yield('content')

    </div>
    <!-- page-body-wrapper ends -->
</div>

@include('partials.app.scripts')
@stack('scripts')

</body>
</html>
