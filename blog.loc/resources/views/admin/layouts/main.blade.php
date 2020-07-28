<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="">
    <title>
        @yield('title','Панель управления')
    </title>
    @yield('styles', '')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{ mix('/css/admin.css') }}">
</head>

<body>
<div class="container">
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
            <a class="navbar-brand brand-logo" href="index.html">
                <!-- <img src="images/logo.png" alt="logo" /> -->
                Портфолио
            </a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center">
            <ul class="navbar-nav navbar-nav-left header-links d-none d-md-flex">
                <!-- <li class="nav-item">
                  <a href="#" class="nav-link">Schedule
                    <span class="badge badge-primary ml-1">New</span>
                  </a>
                </li> -->
                <!-- <li class="nav-item active">
                  <a href="#" class="nav-link">
                    <i class="mdi mdi-elevation-rise"></i>Reports</a>
                </li> -->
                <!-- <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="mdi mdi-bookmark-plus-outline"></i>Score</a>
                </li> -->
            </ul>
            <ul class="navbar-nav navbar-nav-right">
                <!-- <li class="nav-item dropdown">
                  <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-file-document-box"></i>
                    <span class="count">7</span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                    <div class="dropdown-item">
                      <p class="mb-0 font-weight-normal float-left">You have 7 unread mails
                      </p>
                      <span class="badge badge-info badge-pill float-right">View all</span>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item">
                      <div class="preview-thumbnail">
                        <img src="images/faces/face4.jpg" alt="image" class="profile-pic">
                      </div>
                      <div class="preview-item-content flex-grow">
                        <h6 class="preview-subject ellipsis font-weight-medium text-dark">David Grey
                          <span class="float-right font-weight-light small-text">1 Minutes ago</span>
                        </h6>
                        <p class="font-weight-light small-text">
                          The meeting is cancelled
                        </p>
                      </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item">
                      <div class="preview-thumbnail">
                        <img src="images/faces/face2.jpg" alt="image" class="profile-pic">
                      </div>
                      <div class="preview-item-content flex-grow">
                        <h6 class="preview-subject ellipsis font-weight-medium text-dark">Tim Cook
                          <span class="float-right font-weight-light small-text">15 Minutes ago</span>
                        </h6>
                        <p class="font-weight-light small-text">
                          New product launch
                        </p>
                      </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item">
                      <div class="preview-thumbnail">
                        <img src="images/faces/face3.jpg" alt="image" class="profile-pic">
                      </div>
                      <div class="preview-item-content flex-grow">
                        <h6 class="preview-subject ellipsis font-weight-medium text-dark"> Johnson
                          <span class="float-right font-weight-light small-text">18 Minutes ago</span>
                        </h6>
                        <p class="font-weight-light small-text">
                          Upcoming board meeting
                        </p>
                      </div>
                    </a>
                  </div>
                </li> -->
                <!-- <li class="nav-item dropdown">
                  <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                    <i class="mdi mdi-bell"></i>
                    <span class="count">4</span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                    <a class="dropdown-item">
                      <p class="mb-0 font-weight-normal float-left">You have 4 new notifications
                      </p>
                      <span class="badge badge-pill badge-warning float-right">View all</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item">
                      <div class="preview-thumbnail">
                        <div class="preview-icon bg-success">
                          <i class="mdi mdi-alert-circle-outline mx-0"></i>
                        </div>
                      </div>
                      <div class="preview-item-content">
                        <h6 class="preview-subject font-weight-medium text-dark">Application Error</h6>
                        <p class="font-weight-light small-text">
                          Just now
                        </p>
                      </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item">
                      <div class="preview-thumbnail">
                        <div class="preview-icon bg-warning">
                          <i class="mdi mdi-comment-text-outline mx-0"></i>
                        </div>
                      </div>
                      <div class="preview-item-content">
                        <h6 class="preview-subject font-weight-medium text-dark">Settings</h6>
                        <p class="font-weight-light small-text">
                          Private message
                        </p>
                      </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item">
                      <div class="preview-thumbnail">
                        <div class="preview-icon bg-info">
                          <i class="mdi mdi-email-outline mx-0"></i>
                        </div>
                      </div>
                      <div class="preview-item-content">
                        <h6 class="preview-subject font-weight-medium text-dark">New user registration</h6>
                        <p class="font-weight-light small-text">
                          2 days ago
                        </p>
                      </div>
                    </a>
                  </div>
                </li> -->
                <li class="nav-item dropdown d-none d-xl-inline-block">
                    <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                        <span class="profile-text">Привет, Имя пользователя!</span>
                        <!-- <img class="img-xs rounded-circle" src="images/faces/face1.jpg" alt="Profile image"> -->
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                        <!-- <a class="dropdown-item p-0">
                          <div class="d-flex border-bottom">
                            <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                              <i class="mdi mdi-bookmark-plus-outline mr-0 text-gray"></i>
                            </div>
                            <div class="py-3 px-4 d-flex align-items-center justify-content-center border-left border-right">
                              <i class="mdi mdi-account-outline mr-0 text-gray"></i>
                            </div>
                            <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                              <i class="mdi mdi-alarm-check mr-0 text-gray"></i>
                            </div>
                          </div>
                        </a> -->
                        <!-- <a class="dropdown-item mt-2">
                          Manage Accounts
                        </a> -->
                        <a class="dropdown-item" href="">
                            Настройка профиля
                        </a>
                        <!-- <a class="dropdown-item">
                          Check Inbox
                        </a> -->
                        <a class="dropdown-item" href="">
                            Выйти
                        </a>
                    </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
            </button>
        </div>
    </nav>
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item nav-profile">
                <div class="nav-link">
                    <div class="user-wrapper">
                        <!-- <div class="profile-image">
                          <img src="images/faces/face1.jpg" alt="profile image">
                        </div> -->
                        <div class="text-wrapper">
                            <p class="profile-name">Николаенков Роман</p>
                            <div>
                                <small class="designation text-muted">Роль: Админ</small>
                                <!-- <span class="status-indicator online"></span> -->
                            </div>
                        </div>
                    </div>

                </div>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="https://pb24.loc/admin">
                    <i class="menu-icon mdi mdi-television"></i>
                    <span class="menu-title">Панель управления</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="https://pb24.loc/admin/staff">
                    <i class="menu-icon mdi mdi-account-outline"></i>
                    <span class="menu-title">Сотрудники</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="https://pb24.loc/admin/clients">
                    <i class="menu-icon mdi mdi-account-outline"></i>
                    <span class="menu-title">Контакты</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="https://pb24.loc/admin/statuses">
                    <i class="menu-icon mdi mdi-bookmark-plus-outline"></i>
                    <span class="menu-title">Статусы</span>
                </a>
            </li>








            <li class="nav-item active">
                <a class="nav-link" href="https://pb24.loc/admin/accrual">
                    <i class="menu-icon mdi mdi-chart-line"></i>
                    <span class="menu-title">Типы начислений</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="https://pb24.loc/admin/history">
                    <i class="menu-icon mdi mdi-table"></i>
                    <span class="menu-title">История</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="https://pb24.loc/admin/scripts">
                    <i class="menu-icon mdi mdi-file-document-box"></i>
                    <span class="menu-title">Скрипты</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="https://pb24.loc/admin/backups">
                    <i class="menu-icon menu-icon mdi mdi-backup-restore"></i>
                    <span class="menu-title">Бекапы</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="https://pb24.loc/admin/sms/cancel">

                    <span class="menu-title btn btn-danger" style="color: #fff;">Отмена SMS</span>
                </a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="https://pb24.loc/admin/report/parse1s">

                    <span class="menu-title">Скачать ошибки по выгрузке</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="https://pb24.loc/admin/report/sms">

                    <span class="menu-title">Скачать СМС</span>
                </a>
            </li>

        </ul>
    </nav>
</div>


<!-- plugins:js -->
<script src="{{ config('app.url') }}/vendors/js/vendor.bundle.base.js"></script>
<script src="{{ config('app.url') }}/vendors/js/vendor.bundle.addons.js"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="{{ config('app.url') }}/js/off-canvas.js"></script>
<script src="{{ config('app.url') }}/js/misc.js"></script>
<!-- endinject -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- Custom js for this page-->
<script src="{{ config('app.url') }}/js/dashboard.js"></script>
<!-- End custom js for this page-->

@yield('scripts','')

</body>

</html>