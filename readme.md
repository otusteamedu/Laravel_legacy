# Д3 №6. Хранилище данных

При проработке ДЗ изучались:

1. Создание таблиц базы данных через миграции
2. Создание классов моделей и классов связей для отношений ManyToMany
3. Заполнение таблиц данными
4. Накатывание миграции средствами помощника artisan

По задаче, сформулированной в 
[ДЗ4](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw4/readme.md) 
частично создана следующая структура проекта. Таблицы:

1. [Пользователи](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw6/database/migrations/2014_10_12_000000_create_users_table.php) + 
[доп. поля](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw6/database/migrations/2019_09_20_140549_add_photos_surname_birth_to_users_table.php)
2. [Роли](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw6/database/migrations/2019_09_20_111445_create_roles_table.php)
3. [Жанры](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw6/database/migrations/2019_09_18_205819_create_genres_table.php)
4. [Страны](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw6/database/migrations/2019_09_18_210727_create_countries_table.php)
5. [Люди](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw6/database/migrations/2019_09_18_212024_create_people_table.php)
6. [Фильмы](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw6/database/migrations/2019_09_19_134722_create_movies_table.php)
7. [Кинотеатры](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw6/database/migrations/2019_09_20_114853_create_cinemas_table.php)
8. [Залы](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw6/database/migrations/2019_09_20_114910_create_halls_table.php)
9. [Места](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw6/database/migrations/2019_09_20_114921_create_places_table.php)
10. [Тарифы (типы мест)](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw6/database/migrations/2019_09_20_114920_create_tariffs_table.php)
11. [Прокаты фильмов](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw6/database/migrations/2019_09_20_143313_create_movie_rentals_table.php)
12. [Сеансы проката фильмы](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw6/database/migrations/2019_09_20_143416_create_movie_showings_table.php)
13. [Цена на фильм в зависимости от тарифа](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw6/database/migrations/2019_09_20_143431_create_showing_prices_table.php)
14. [Файлы](https://github.com/otusteamedu/Laravel/blob/VYermakov/hw6/database/migrations/2019_09_18_203050_create_files_table.php)

Модели создавались вместе с таблицами и находятся тут [/app/Models](https://github.com/otusteamedu/Laravel/tree/VYermakov/hw6/app/Models). 
Их оформление будет идти по мере проработки проекта.

Модели будут меняться и добавляться.

Для первых двух простых моделей были созданы [фабрики](https://github.com/otusteamedu/Laravel/tree/VYermakov/hw6/database/factories) и 
[сиды](https://github.com/otusteamedu/Laravel/tree/VYermakov/hw6/database/seeds).

