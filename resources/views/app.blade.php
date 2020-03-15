@include('partials.app.header')

<body>

<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->

@include('partials.app.nav')

<!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->

    @include('partials.app.nav-sidebar')

    <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                @yield('content')
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->

        @include('partials.app.footer')

        <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>

@include('partials.app.scripts')
@stack('scripts')

</body>
</html>
