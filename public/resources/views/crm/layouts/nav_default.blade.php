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
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

            @section('content')

            @show

        </main>
    </div>
</div>
@include('crm.layouts.footer')
