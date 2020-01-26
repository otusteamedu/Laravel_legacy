<nav>
    <p>
        <!-- Общий доступ -->
        <a href="/" id="index">Главная</a>
        <a href="/katalog" id="katalog">Каталог</a>

        <!-- Доступ авторизованным -->
        @auth
            <a href="/home" id="home">Мой кабинет</a>&nbsp;
            <a href="/profile" id="profile">Мой профиль</a>
        @else
            <!-- Неавторизованным показать -->
            <a href="/login" id="login">Вход</a>&nbsp;
            <a href="/register" id="register">Регистрация</a>
        @endauth
        <!-- Доступ админу -->
        @admin
        <a href="/users" id="users">&#128522; Пользователи</a>
        @endadmin
        <!-- Доступ авторизованным -->
        @auth
            <a href="/logout">Выйти</a>
        @endauth
    </p>
</nav>
