@extends('layout._layout')



@section('breadcrumbs')
<ol class="breadcrumb text-right">
    <li class="active">Dashboard</li>
</ol>
@stop

@section('content')

{{--<div class="col-sm-12">
    <div class="alert  alert-success alert-dismissible fade show" role="alert">
        <span class="badge badge-pill badge-success">Success</span> You successfully read this important alert message.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>--}}


<div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-1">
        <div class="card-body pb-0">
            <div class="dropdown float-right">
                <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton1" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <div class="dropdown-menu-content">
                        <a class="dropdown-item" href="">Создать группу</a>
                        <a class="dropdown-item" href="">Создать группу</a>
                    </div>
                </div>
            </div>
            <h4 class="mb-0">
                <span class="count">2</span>
            </h4>

            <p class="text-light">группы</p>

            <div class="chart-wrapper px-0" style="height:70px;" height="70">
                <canvas id="widgetChart1"></canvas>
            </div>

        </div>

    </div>
</div>
<!--/.col-->

<div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-2">
        <div class="card-body pb-0">
            <div class="dropdown float-right">
                <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton2" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                    <div class="dropdown-menu-content">
                        <a class="dropdown-item" href="#">Администрирование ответственности</a>
                    </div>
                </div>
            </div>
            <h4 class="mb-0">
                <span class="count">10</span>
            </h4>

            <p class="text-light">Пользователей</p>

            <div class="chart-wrapper px-0" style="height:70px;" height="70">
                <canvas id="widgetChart2"></canvas>
            </div>

        </div>
    </div>
</div>
<!--/.col-->

<div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-3">
        <div class="card-body pb-0">
            <div class="dropdown float-right">
                <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton3" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                    <div class="dropdown-menu-content">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            <h4 class="mb-0">
                <span class="count">23</span>
            </h4>

            <p class="text-light">Ответственности</p>

        </div>

        <div class="chart-wrapper px-0" style="height:70px;" height="70">
            <canvas id="widgetChart3"></canvas>
        </div>
    </div>
</div>
<!--/.col-->

<div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-4">
        <div class="card-body pb-0">
            <div class="dropdown float-right">
                <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton4" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                    <div class="dropdown-menu-content">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            <h4 class="mb-0">
                <span class="count">10468</span>
            </h4>

            <p class="text-light">Members online</p>

            <div class="chart-wrapper px-3" style="height:70px;" height="70">
                <canvas id="widgetChart4"></canvas>
            </div>

        </div>
    </div>
</div>
<!--/.col-->

<div class="col-lg-9">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Название группы</strong>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="col-xl-3 col-lg-6">
    <div class="card">
        <div class="card-body">
            <div class="stat-widget-one">
                <div class="stat-icon dib"><i class="ti-money text-success border-success"></i></div>
                <div class="stat-content dib">
                    <div class="stat-text">Total Profit</div>
                    <div class="stat-digit">1,012</div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="col-xl-3 col-lg-6">
    <div class="card">
        <div class="card-body">
            <div class="stat-widget-one">
                <div class="stat-icon dib"><i class="ti-user text-primary border-primary"></i></div>
                <div class="stat-content dib">
                    <div class="stat-text">New Customer</div>
                    <div class="stat-digit">961</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-3 col-lg-6">
    <div class="card">
        <div class="card-body">
            <div class="stat-widget-one">
                <div class="stat-icon dib"><i class="ti-layout-grid2 text-warning border-warning"></i></div>
                <div class="stat-content dib">
                    <div class="stat-text">Active Projects</div>
                    <div class="stat-digit">770</div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop