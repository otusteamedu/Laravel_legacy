@include('layouts.partials.header')

<body>

<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->

@include('layouts.partials.nav')

<!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->

    @include('layouts.partials.nav-sidebar')

    <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                @yield('content')
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->

        @include('layouts.partials.footer')

        <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>

@include('layouts.partials.scripts')
@stack('scripts')

</body>
</html>
