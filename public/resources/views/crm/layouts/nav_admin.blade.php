@include('crm.layouts.header')
<br><br>
<div class="container-fluid" style="margin-top:70px;">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="/crm">
                            <br><br>
                            Панель управления <span class="sr-only">(current)</span>
                        </a>
                    </li>
                </ul>

                <h6 class="sidebar-heading d-flex align-items-center px-3 mt-4 mb-1 text-muted">
                    <span data-feather="truck"></span>&nbsp;&nbsp;Транспорт
                </h6>
                <ul class="nav flex-column mb-2">
                    @foreach ($leftNav['transports'] as $name => $route)
                    <li class="nav-item">
                        {{ link_to(route($route), $name, ['class' => 'nav-link']) }}
                    </li>
                    @endforeach
                </ul>

                <h6 class="sidebar-heading d-flex align-items-center px-3 mt-4 mb-1 text-muted">
                    <span data-feather="trello"></span>&nbsp;&nbsp;Автосалоны
                </h6>
                <ul class="nav flex-column mb-2">
                    @foreach ($leftNav['clients'] as $name => $route)
                        <li class="nav-item">
                            {{ link_to(route($route), $name, ['class' => 'nav-link']) }}
                        </li>
                    @endforeach
                </ul>

                <h6 class="sidebar-heading d-flex align-items-center px-3 mt-4 mb-1 text-muted">
                    <span data-feather="map"></span>&nbsp;&nbsp;Расписание</span>
                </h6>
                <ul class="nav flex-column mb-2">
                    @foreach ($leftNav['schedule'] as $name => $route)
                        <li class="nav-item">
                            {{ link_to(route($route), $name, ['class' => 'nav-link']) }}
                        </li>
                    @endforeach
                </ul>

                <h6 class="sidebar-heading d-flex align-items-center px-3 mt-4 mb-1 text-muted">
                    <span data-feather="file"></span>&nbsp;&nbsp;Заказы
                </h6>
                <ul class="nav flex-column mb-2">
                    @foreach ($leftNav['orders'] as $name => $route)
                        <li class="nav-item">
                            {{ link_to(route($route), $name, ['class' => 'nav-link']) }}
                        </li>
                    @endforeach
                </ul>

                <h6 class="sidebar-heading d-flex align-items-center px-3 mt-4 mb-1 text-muted">
                    <span data-feather="bar-chart"></span>&nbsp;&nbsp;Статистика
                </h6>
                <ul class="nav flex-column mb-2">
                    @foreach ($leftNav['stats'] as $name => $route)
                        <li class="nav-item">
                            {{ link_to(route($route), $name, ['class' => 'nav-link']) }}
                        </li>
                    @endforeach
                </ul>


            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

            @section('content')

            @show

        </main>
    </div>
</div>
@include('crm.layouts.footer')
