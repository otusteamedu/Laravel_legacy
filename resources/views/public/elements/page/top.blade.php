<div class="page-top bg-dark clearfix">
    <div class="float-left">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <a class="navbar-brand page-brand rounded bg-primary" href="{{ route('public.start') }}">
                <i class="fas fa-video"></i>
            </a>
            @include('public.elements.topmenu')
        </nav>
    </div>
    <div class="float-right page-buttons">
        <nav class="navbar">
            <ul class="nav nav-pills">
                <!--li class="nav-item dropdown">
                    <a class="nav-item nav-link dropdown-toggle mr-md-2" href="#" id="bd-versions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        v4.3.1</a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="bd-versions">
                        <a class="dropdown-item " href="/docs/4.0/" title="Версия Bootstrap v4.0.0 (Rus)">v4.0.0</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item " href="/docs/3.4/" title="Версия Bootstrap v3.4.0 (Rus)"> Новая (v3.4.0)</a>
                    </div>
                </li-->
                <li class="nav-item">
                    @include('public.elements.topsearch')
                </li>
                <li class="nav-item">
                    @include('public.elements.auth')
                </li>
                <li class="nav-item">
                    @include('public.elements.myorder')
                </li>
            </ul>
        </nav>
    </div>
</div>
