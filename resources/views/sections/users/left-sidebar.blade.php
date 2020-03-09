<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-small-cap">Основной функционал</li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Операции </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('home')}}">Список операций</a></li>
                        <li><a href="/operation/create">Добавить операцию</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-laptop-windows"></i><span class="hide-menu">Долги</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="../minisidebar/index.html">Мне должны</a></li>
                        <li><a href="../horizontal/index2.html">Я должен</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-bullseye"></i><span class="hide-menu">Отчеты</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="app-calendar.html">Сегодня</a></li>
                        <li><a href="app-chat.html">Вчера</a></li>
                        <li><a href="app-ticket.html">Неделя</a></li>
                        <li><a href="app-contact.html">Месяц</a></li>
                        <li><a href="app-contact2.html">Квартал</a></li>
                        <li><a href="app-contact-detail.html">Год</a></li>
                        <li><a href="app-contact-detail.html">Выбрать период</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-email"></i><span class="hide-menu">Категории</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="app-email.html">Список</a></li>
                        <li><a href="app-email-detail.html">Добавить</a></li>
                        <li><a href="app-compose.html">Редактировать</a></li>
                        <li><a href="app-compose.html">Удалить</a></li>
                    </ul>
                </li>
                <li class="nav-devider"></li>
                <li class="nav-small-cap">Дополнительный функционал</li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-file"></i><span class="hide-menu">Бюджет</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="form-basic.html">Список</a></li>
                        <li><a href="form-layout.html">Добавить</a></li>
                        <li><a href="form-addons.html">Редактировать</a></li>
                        <li><a href="form-material.html">Удалить</a></li>
                    </ul>
                </li>
                <li class="nav-devider"></li>
                <li class="nav-small-cap">Настройки</li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-book-multiple"></i><span class="hide-menu">Опции</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="layout-single-column.html">Изменить цвет текста</a></li>
                        <li><a href="layout-fix-header.html">Выбрать диаграммы</a></li>
                        <li><a href="layout-fix-sidebar.html">Загрузить иконки</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-book-open-variant"></i><span class="hide-menu">Помощь</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="#" class="has-arrow">FAQ <span class="label label-rounded label-success">6</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="pages-login.html">Как добавить цель</a></li>
                                <li><a href="pages-login-2.html">Как создать категорию</a></li>
                                <li><a href="pages-register.html">Как загрузить чек</a></li>
                            </ul>
                        </li>
                        <li><a href="pages-blank.html">Задать вопрос</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-book-multiple"></i><span class="hide-menu">Отзывы</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('reviews.index')}}">Отзывы</a></li>
                        <li><a href="{{route('reviews.create')}}">Добавить отзыв</a></li>
                    </ul>
                </li>
{{--                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-book-multiple"></i><span class="hide-menu">Для разработчиков</span></a>--}}
{{--                    <ul aria-expanded="false" class="collapse">--}}
{{--                        <li><a href="{{route('admin.oauth')}}">OAuth</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->