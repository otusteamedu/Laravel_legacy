@include('layouts.partials.header')

<body>

<div class="container-scroller">
<!-- partial -->
    <div class="container-fluid page-body-wrapper full-page-wrapper">

       @yield('content')

    </div>
    <!-- page-body-wrapper ends -->
</div>

@include('layouts.partials.scripts')
@stack('scripts')

</body>
</html>
