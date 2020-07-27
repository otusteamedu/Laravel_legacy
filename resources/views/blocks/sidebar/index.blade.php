<div class="col-md-4 col-lg-3 navbar-container bg-dark">
    <nav class="navbar navbar-expand-md navbar-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">@lang('scheduler.home')</a>
                </li>
                @include('blocks.sidebar.main')
                @include('blocks.sidebar.admin')
            </ul>
        </div>
    </nav>
</div>
