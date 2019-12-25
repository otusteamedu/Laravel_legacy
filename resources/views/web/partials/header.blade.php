<header>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
        <h5 class="my-0 mr-md-auto font-weight-normal"><a class="text-dark" href="/">Strava Clone</a></h5>
        <nav class="my-2 my-md-0 mr-md-3">
            <a class="p-2 text-dark" href="/">Home</a>
            <a class="p-2 text-dark" href="/dashboard">Dashboard</a>
            <a class="p-2 text-dark" href="/content">Content</a>
        </nav>
        @guest
            <a class="btn btn-outline-primary" href="{{ route('register') }}">Sign up</a>
            <a class="btn btn-primary ml-2" href="{{ route('login') }}">Sign in</a>
        @else
            <a class="btn btn-primary" href="{{ route('backend') }}">Backend</a>
        @endguest
    </div>
</header>